<?php

namespace App\Observers;

use App\Mail\AgentApprove;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AgentObserver
{
    public function updated(Agent $agent): void
    {
        if (! $agent->wasChanged('status') || ! $agent->isActive()) {
            return;
        }

        if (filled($agent->getOriginal('password'))) {
            return;
        }

        $plainPassword = Str::password(12);
        $agent->forceFill(['password' => Hash::make($plainPassword)]);
        $agent->saveQuietly();

        Mail::to($agent->email)->send(new AgentApprove([
            'name' => $agent->name,
            'password' => $plainPassword,
        ]));
    }
}
