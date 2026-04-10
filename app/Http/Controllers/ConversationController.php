<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ConversationController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        $conversations = $user->conversations()
            ->orderByRaw('COALESCE(last_message_at, updated_at) DESC')
            ->get()
            ->map(function (Conversation $c) {
                $preview = $c->latestMessage();

                return [
                    'id' => $c->id,
                    'subject' => $c->subject ?? 'Support',
                    'status' => $c->status,
                    'is_open' => $c->isOpen(),
                    'last_message_at' => $c->last_message_at?->toIso8601String(),
                    'preview' => $preview ? mb_strimwidth(strip_tags($preview->body), 0, 120, '…') : null,
                    'unread' => $c->unreadMessagesForUser() > 0,
                ];
            })
            ->values()
            ->all();

        return Inertia::render('Account/Messages/Index', [
            'conversations' => $conversations,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Conversation::class);

        $data = $request->validate([
            'subject' => ['nullable', 'string', 'max:120'],
            'body' => ['required', 'string', 'max:5000'],
        ]);

        $conversation = Conversation::query()->create([
            'user_id' => $request->user()->id,
            'subject' => filled($data['subject'] ?? null) ? $data['subject'] : null,
            'status' => Conversation::STATUS_OPEN,
            'user_last_read_at' => now(),
            'last_message_at' => now(),
        ]);

        ConversationMessage::query()->create([
            'conversation_id' => $conversation->id,
            'sender_type' => User::class,
            'sender_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        return redirect()->route('messages.show', $conversation);
    }

    public function show(Request $request, Conversation $conversation): Response
    {
        $this->authorize('view', $conversation);

        $conversation->update(['user_last_read_at' => now()]);

        $conversation->loadMissing('messages.sender');

        $messages = $conversation->messages->map(function (ConversationMessage $m) use ($request) {
            $sender = $m->sender;
            $isMe = $sender instanceof \App\Models\User && (int) $sender->id === (int) $request->user()->id;

            return [
                'id' => $m->id,
                'body' => $m->body,
                'created_at' => $m->created_at->toIso8601String(),
                'is_me' => $isMe,
                'sender_label' => $isMe ? 'You' : 'Support',
            ];
        })->values()->all();

        return Inertia::render('Account/Messages/Show', [
            'conversation' => [
                'id' => $conversation->id,
                'subject' => $conversation->subject ?? 'Support',
                'status' => $conversation->status,
                'is_open' => $conversation->isOpen(),
            ],
            'messages' => $messages,
        ]);
    }

    public function appendMessage(Request $request, Conversation $conversation): RedirectResponse
    {
        $this->authorize('reply', $conversation);

        $data = $request->validate([
            'body' => ['required', 'string', 'max:5000'],
        ]);

        ConversationMessage::query()->create([
            'conversation_id' => $conversation->id,
            'sender_type' => User::class,
            'sender_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        $conversation->update(['user_last_read_at' => now()]);

        return redirect()->route('messages.show', $conversation);
    }
}
