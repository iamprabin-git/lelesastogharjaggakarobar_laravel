<?php

use App\Filament\Agent\Auth\AgentPanelLogin;
use App\Models\Agent;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

beforeEach(function () {
    Filament::setCurrentPanel('agent');
});

it('shows a clear validation message when the agent is inactive', function () {
    $agent = Agent::factory()->inactive()->create([
        'password' => bcrypt('secret'),
    ]);

    Livewire::test(AgentPanelLogin::class)
        ->set('data.email', $agent->email)
        ->set('data.password', 'secret')
        ->call('authenticate')
        ->assertHasErrors(['data.email']);

    expect(Auth::guard('agent')->check())->toBeFalse();
});

it('blocks login when access is expired', function () {
    $agent = Agent::factory()->expired()->create([
        'password' => bcrypt('secret'),
    ]);

    Livewire::test(AgentPanelLogin::class)
        ->set('data.email', $agent->email)
        ->set('data.password', 'secret')
        ->call('authenticate')
        ->assertHasErrors(['data.email']);

    expect(Auth::guard('agent')->check())->toBeFalse();
});

it('logs in an active non-expired agent', function () {
    $agent = Agent::factory()->create([
        'status' => true,
        'expiry_date' => null,
        'password' => bcrypt('secret'),
    ]);

    Livewire::test(AgentPanelLogin::class)
        ->set('data.email', $agent->email)
        ->set('data.password', 'secret')
        ->call('authenticate')
        ->assertHasNoErrors();

    expect(Auth::guard('agent')->check())->toBeTrue();
    expect(Auth::guard('agent')->id())->toBe($agent->id);
});

it('resolves active status from database values', function () {
    expect(Agent::factory()->make(['status' => true])->isActive())->toBeTrue();
    expect(Agent::factory()->make(['status' => false])->isActive())->toBeFalse();
    expect(Agent::factory()->make(['expiry_date' => now()->subDay()])->isAccessExpired())->toBeTrue();
    expect(Agent::factory()->make(['expiry_date' => now()->addDay()])->isAccessExpired())->toBeFalse();
});
