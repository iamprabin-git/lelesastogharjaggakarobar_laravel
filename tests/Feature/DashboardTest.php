<?php

use App\Models\User;
use App\Models\UserPropertySearch;

it('redirects guests from the account area', function () {
    $this->get('/account')->assertRedirect(route('login', absolute: false));
});

it('shows the account home for a verified user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/account')
        ->assertOk();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertRedirect('/account');
});

it('returns json property suggestions for authenticated users', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->getJson('/account/property-suggestions?q=zznonexistent999xyz')
        ->assertOk()
        ->assertJson([]);
});

it('stores a property search row when an authenticated user uses listing filters', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/properties?keyword=land+plot');

    expect(UserPropertySearch::query()->where('user_id', $user->id)->count())->toBe(1);

    $row = UserPropertySearch::query()->where('user_id', $user->id)->first();
    expect($row->keyword)->toBe('land plot');
});
