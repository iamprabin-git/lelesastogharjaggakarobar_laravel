<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    public const STATUS_OPEN = 'open';

    public const STATUS_CLOSED = 'closed';

    protected $fillable = [
        'user_id',
        'subject',
        'status',
        'user_last_read_at',
        'admin_last_read_at',
        'last_message_at',
    ];

    protected function casts(): array
    {
        return [
            'user_last_read_at' => 'datetime',
            'admin_last_read_at' => 'datetime',
            'last_message_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ConversationMessage::class)->orderBy('id');
    }

    public function latestMessage(): ?ConversationMessage
    {
        return $this->messages()->reorder('id', 'desc')->first();
    }

    public function isOpen(): bool
    {
        return $this->status === self::STATUS_OPEN;
    }

    public function unreadMessagesForAdmin(): int
    {
        $since = $this->admin_last_read_at;

        return (int) $this->messages()
            ->where('sender_type', User::class)
            ->when($since, fn ($q) => $q->where('created_at', '>', $since))
            ->count();
    }

    public function unreadMessagesForUser(): int
    {
        $since = $this->user_last_read_at;

        return (int) $this->messages()
            ->where('sender_type', Admin::class)
            ->when($since, fn ($q) => $q->where('created_at', '>', $since))
            ->count();
    }

    public static function unreadAdminMessagesCountForUser(User $user): int
    {
        return (int) ConversationMessage::query()
            ->join('conversations', 'conversations.id', '=', 'conversation_messages.conversation_id')
            ->where('conversations.user_id', $user->id)
            ->where('conversation_messages.sender_type', Admin::class)
            ->where(function ($q) {
                $q->whereNull('conversations.user_last_read_at')
                    ->orWhereColumn('conversation_messages.created_at', '>', 'conversations.user_last_read_at');
            })
            ->count();
    }

    public static function unreadConversationsCountForAdmin(): int
    {
        return (int) static::query()
            ->whereExists(function ($q) {
                $q->selectRaw('1')
                    ->from('conversation_messages')
                    ->whereColumn('conversation_messages.conversation_id', 'conversations.id')
                    ->where('conversation_messages.sender_type', User::class)
                    ->where(function ($q2) {
                        $q2->whereNull('conversations.admin_last_read_at')
                            ->orWhereColumn('conversation_messages.created_at', '>', 'conversations.admin_last_read_at');
                    });
            })
            ->count();
    }
}
