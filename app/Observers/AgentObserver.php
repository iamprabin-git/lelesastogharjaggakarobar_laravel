<?php

namespace App\Observers;

use App\Mail\AgentApprove;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AgentObserver
{
    /**
     * Handle the Agent "created" event.
     */
    public function created(Agent $agent): void
    {
        //
    }

    /**
     * Handle the Agent "updated" event.
     */
    public function updated(Agent $agent): void
    {
        if ($agent->isDirty('status') && $agent->status == 1) {
            // Only generate temp password if agent has no password
            if (!$agent->password) {
                $password = rand(100000, 999999);
                $agent->password = Hash::make($password);
                $agent->saveQuietly();

                $data = [
                    'email' => $agent->email,
                    'name' => $agent->name,
                    'password' => $password,

                ];

                Mail::to($agent->email)->send(new AgentApprove($data));
            }
        }
    }

    /**
     * Handle the Agent "deleted" event.
     */
    public function deleted(Agent $agent): void
    {
        //
    }

    /**
     * Handle the Agent "restored" event.
     */
    public function restored(Agent $agent): void
    {
        //
    }

    /**
     * Handle the Agent "force deleted" event.
     */
    public function forceDeleted(Agent $agent): void
    {
        //
    }
}
