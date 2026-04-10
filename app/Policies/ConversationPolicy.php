<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Conversation;
use App\Models\User;

class ConversationPolicy
{
    public function viewAny(User|Admin $user): bool
    {
        return true;
    }

    public function view(User|Admin $user, Conversation $conversation): bool
    {
        if ($user instanceof Admin) {
            return true;
        }

        return (int) $conversation->user_id === (int) $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function reply(User|Admin $user, Conversation $conversation): bool
    {
        if ($user instanceof Admin) {
            return true;
        }

        return (int) $conversation->user_id === (int) $user->id && $conversation->isOpen();
    }
}
