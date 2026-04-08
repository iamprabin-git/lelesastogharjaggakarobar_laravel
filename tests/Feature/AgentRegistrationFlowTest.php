<?php

use App\Mail\AgentRequestNotification;
use App\Mail\AgentWelcomeMail;
use App\Models\Admin;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

it('creates a pending agent and sends welcome plus admin notification with agents URL', function () {
    Mail::fake();

    Admin::query()->create([
        'name' => 'Test Admin',
        'email' => 'admin-notify@example.test',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('agent.store'), [
        'name' => 'New Agent',
        'email' => 'new-agent-flow@example.test',
        'phone' => '9800000000',
        'password' => 'password12',
        'password_confirmation' => 'password12',
    ]);

    $response->assertRedirect(route('home'));
    $response->assertSessionHas('success');

    $agent = Agent::query()->where('email', 'new-agent-flow@example.test')->first();
    expect($agent)->not->toBeNull();
    expect($agent->isActive())->toBeFalse();

    Mail::assertSent(AgentWelcomeMail::class, function (AgentWelcomeMail $mail) {
        $html = $mail->render();

        return str_contains($html, '/agent/login')
            && str_contains($html, 'administrator');
    });

    Mail::assertSent(AgentRequestNotification::class, function (AgentRequestNotification $mail) {
        $html = $mail->render();

        return str_contains($html, '/admin/agents')
            && str_contains($html, $mail->data['email']);
    });
});

it('does not send admin notification when no admins have an email on file', function () {
    Mail::fake();

    Admin::query()->delete();

    $this->post(route('agent.store'), [
        'name' => 'Solo Agent',
        'email' => 'solo-agent@example.test',
        'phone' => '9800000001',
        'password' => 'password12',
        'password_confirmation' => 'password12',
    ])->assertRedirect(route('home'));

    Mail::assertSent(AgentWelcomeMail::class);
    Mail::assertNotSent(AgentRequestNotification::class);
});
