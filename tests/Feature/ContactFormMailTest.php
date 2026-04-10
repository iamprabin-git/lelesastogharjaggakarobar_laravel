<?php

use App\Mail\SiteContactFormMail;
use App\Models\Admin;
use App\Models\Company;
use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

it('sends contact form mail to admins with reply-to visitor', function () {
    Mail::fake();

    Admin::query()->create([
        'name' => 'Admin',
        'email' => 'office@example.test',
        'password' => Hash::make('password'),
    ]);

    $response = $this->from('/contact')->post('/contact', [
        'name' => 'Visitor',
        'email' => 'visitor@example.test',
        'phone' => '9800000000',
        'message' => 'Hello from the form.',
    ]);

    $response->assertSessionHas('success');

    expect(ContactSubmission::query()->count())->toBe(1);

    Mail::assertSent(SiteContactFormMail::class, function (SiteContactFormMail $mail): bool {
        $reply = $mail->envelope()->replyTo[0] ?? null;

        return $mail->hasTo('office@example.test')
            && $reply !== null
            && $reply->address === 'visitor@example.test'
            && $mail->payload['message'] === 'Hello from the form.'
            && $mail->adminViewUrl !== null;
    });
});

it('includes company email when set and not duplicate of admin', function () {
    Mail::fake();

    Admin::query()->create([
        'name' => 'Admin',
        'email' => 'admin@example.test',
        'password' => Hash::make('password'),
    ]);

    Company::query()->create([
        'name' => 'Co',
        'email' => 'company@example.test',
        'phone' => '1',
        'address' => 'Here',
        'status' => true,
    ]);

    $this->from('/contact')->post('/contact', [
        'name' => 'A',
        'email' => 'a@example.test',
        'message' => 'Hi',
    ])->assertSessionHas('success');

    Mail::assertSent(SiteContactFormMail::class, function (SiteContactFormMail $mail): bool {
        return $mail->hasTo('admin@example.test') && $mail->hasTo('company@example.test');
    });
});
