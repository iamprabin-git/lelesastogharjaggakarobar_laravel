<?php

use App\Mail\PropertyInquiryAdminMail;
use App\Mail\PropertyInquiryAgentMail;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Property;
use App\Models\PropertyInquiry;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

it('stores inquiry and emails listing agent and admins with reply-to buyer (no login required)', function () {
    Mail::fake();

    Admin::query()->create([
        'name' => 'Admin',
        'email' => 'crm-admin@example.test',
        'password' => Hash::make('password'),
    ]);

    $agent = Agent::factory()->create([
        'email' => 'listing-agent@example.test',
    ]);

    $property = Property::query()->create([
        'title' => 'Test plot',
        'description' => 'Description',
        'price' => 1_000_000,
        'type' => 'sale',
        'status' => 'approved',
        'availability' => 'available',
        'agent_id' => $agent->id,
    ]);

    $response = $this->from(route('properties.show', $property))
        ->post(route('agent.contact', $agent), [
            'property_id' => $property->id,
            'name' => 'Buyer Name',
            'email' => 'buyer@example.test',
            'phone' => '9801111111',
            'message' => 'Interested in this land.',
        ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    expect(PropertyInquiry::query()->count())->toBe(1);

    Mail::assertSent(PropertyInquiryAgentMail::class, function (PropertyInquiryAgentMail $mail) use ($agent): bool {
        $reply = $mail->envelope()->replyTo[0] ?? null;

        return $mail->hasTo($agent->email)
            && $reply !== null
            && $reply->address === 'buyer@example.test';
    });

    Mail::assertSent(PropertyInquiryAdminMail::class, function (PropertyInquiryAdminMail $mail): bool {
        $reply = $mail->envelope()->replyTo[0] ?? null;

        return $mail->hasTo('crm-admin@example.test')
            && $reply !== null
            && $reply->address === 'buyer@example.test';
    });
});

it('does not send admin inquiry mail when no admins have email', function () {
    Mail::fake();

    Admin::query()->delete();

    $agent = Agent::factory()->create([
        'email' => 'solo-listing-agent@example.test',
    ]);

    $property = Property::query()->create([
        'title' => 'Solo plot',
        'description' => 'Desc',
        'price' => 500_000,
        'type' => 'sale',
        'status' => 'approved',
        'availability' => 'available',
        'agent_id' => $agent->id,
    ]);

    $this->from(route('properties.show', $property))
        ->post(route('agent.contact', $agent), [
            'property_id' => $property->id,
            'name' => 'Buyer',
            'email' => 'buyer2@example.test',
            'message' => 'Hello',
        ])
        ->assertSessionHas('success');

    Mail::assertSent(PropertyInquiryAgentMail::class);
    Mail::assertNotSent(PropertyInquiryAdminMail::class);
});

it('rejects inquiry when property does not belong to the agent', function () {
    Mail::fake();

    $listingAgent = Agent::factory()->create();
    $otherAgent = Agent::factory()->create();

    $property = Property::query()->create([
        'title' => 'Other agent plot',
        'description' => 'Desc',
        'price' => 800_000,
        'type' => 'sale',
        'status' => 'approved',
        'availability' => 'available',
        'agent_id' => $otherAgent->id,
    ]);

    $this->from(route('properties.show', $property))
        ->post(route('agent.contact', $listingAgent), [
            'property_id' => $property->id,
            'name' => 'Buyer',
            'email' => 'buyer@example.test',
            'message' => 'Scam attempt',
        ])
        ->assertForbidden();

    expect(PropertyInquiry::query()->count())->toBe(0);
    Mail::assertNothingSent();
});
