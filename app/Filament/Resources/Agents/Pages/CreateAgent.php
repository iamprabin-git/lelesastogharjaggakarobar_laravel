<?php

namespace App\Filament\Resources\Agents\Pages;

use App\Filament\Resources\Agents\AgentResource;
use App\Mail\AdminAgentCreatedNotification;
use App\Mail\AgentAccountCreatedMail;
use App\Models\Admin;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CreateAgent extends CreateRecord
{
    protected static string $resource = AgentResource::class;

    protected ?string $plainPassword = null;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (! empty($data['password'])) {
            $this->plainPassword = $data['password'];
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $agent = $this->record;

        if ($this->plainPassword) {
            Mail::to($agent->email)->send(new AgentAccountCreatedMail([
                'name' => $agent->name,
                'email' => $agent->email,
                'password' => $this->plainPassword,
            ]));
        }

        $adminEmails = Admin::whereNotNull('email')->pluck('email')->toArray();
        if ($adminEmails !== []) {
            Mail::to($adminEmails)->send(new AdminAgentCreatedNotification([
                'name' => $agent->name,
                'email' => $agent->email,
                'phone' => $agent->phone,
            ]));
        }
    }
}
