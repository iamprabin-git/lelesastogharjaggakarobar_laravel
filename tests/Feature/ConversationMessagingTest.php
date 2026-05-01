<?php

use App\Models\Admin;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('lets a verified user start a conversation and view the thread', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/account/messages', [
            'subject' => 'Need help',
            'body' => 'Hello support team.',
        ])
        ->assertRedirect();

    $conv = Conversation::query()->where('user_id', $user->id)->first();
    expect($conv)->not->toBeNull();
    expect($conv->messages()->count())->toBe(1);

    $this->actingAs($user)
        ->get('/account/messages/'.$conv->id)
        ->assertOk();
});

it('forbids viewing another users conversation', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $conv = Conversation::query()->create([
        'user_id' => $owner->id,
        'subject' => 'Private',
        'status' => Conversation::STATUS_OPEN,
        'user_last_read_at' => now(),
        'last_message_at' => now(),
    ]);

    $this->actingAs($other)
        ->get('/account/messages/'.$conv->id)
        ->assertForbidden();
});

it('lets a user reply on an open thread', function () {
    $user = User::factory()->create();

    $conv = Conversation::query()->create([
        'user_id' => $user->id,
        'status' => Conversation::STATUS_OPEN,
        'user_last_read_at' => now(),
        'last_message_at' => now(),
    ]);

    ConversationMessage::query()->create([
        'conversation_id' => $conv->id,
        'sender_type' => User::class,
        'sender_id' => $user->id,
        'body' => 'First',
    ]);

    $this->actingAs($user)
        ->post('/account/messages/'.$conv->id.'/messages', [
            'body' => 'Second line',
        ])
        ->assertRedirect();

    expect($conv->messages()->count())->toBe(2);
});

it('reopens a closed thread when the member replies', function () {
    $user = User::factory()->create();

    $conv = Conversation::query()->create([
        'user_id' => $user->id,
        'status' => Conversation::STATUS_CLOSED,
        'user_last_read_at' => now(),
        'last_message_at' => now(),
    ]);

    $this->actingAs($user)
        ->post('/account/messages/'.$conv->id.'/messages', [
            'body' => 'Please reopen — I still need help.',
        ])
        ->assertRedirect();

    expect($conv->fresh()->status)->toBe(Conversation::STATUS_OPEN);
    expect($conv->messages()->count())->toBe(1);
});

it('returns poll updates json for the conversation owner', function () {
    $user = User::factory()->create();

    $conv = Conversation::query()->create([
        'user_id' => $user->id,
        'status' => Conversation::STATUS_OPEN,
        'user_last_read_at' => now(),
        'last_message_at' => now(),
    ]);

    ConversationMessage::query()->create([
        'conversation_id' => $conv->id,
        'sender_type' => User::class,
        'sender_id' => $user->id,
        'body' => 'Hello',
    ]);

    $this->actingAs($user)
        ->getJson('/account/messages/'.$conv->id.'/updates')
        ->assertOk()
        ->assertJsonStructure([
            'conversation' => ['id', 'subject', 'status', 'is_open'],
            'messages' => [
                '*' => ['id', 'body', 'created_at', 'is_me', 'sender_label'],
            ],
        ]);
});

it('allows an admin to open the filament inbox', function () {
    $admin = Admin::query()->create([
        'name' => 'Desk',
        'email' => 'desk@example.test',
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($admin, 'admin')
        ->get('/admin/conversations')
        ->assertOk();
});
