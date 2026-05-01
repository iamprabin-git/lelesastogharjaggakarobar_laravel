<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ConversationMessage extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_type',
        'sender_id',
        'body',
    ];

    protected static function booted(): void
    {
        static::created(function (ConversationMessage $message) {
            $conversation = $message->conversation;
            $payload = ['last_message_at' => $message->created_at];
            if ($conversation->status === Conversation::STATUS_CLOSED) {
                $payload['status'] = Conversation::STATUS_OPEN;
            }
            $conversation->update($payload);
        });
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender(): MorphTo
    {
        return $this->morphTo();
    }
}
