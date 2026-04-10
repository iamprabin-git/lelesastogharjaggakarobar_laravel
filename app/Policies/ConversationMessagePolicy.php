<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\ConversationMessage;

class ConversationMessagePolicy
{
    public function viewAny(mixed $user): bool
    {
        return $user instanceof Admin;
    }

    public function create(mixed $user): bool
    {
        return $user instanceof Admin;
    }

    public function view(mixed $user, ConversationMessage $conversationMessage): bool
    {
        return $user instanceof Admin;
    }
}
