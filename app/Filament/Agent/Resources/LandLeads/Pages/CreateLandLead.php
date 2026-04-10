<?php

namespace App\Filament\Agent\Resources\LandLeads\Pages;

use App\Filament\Agent\Resources\LandLeads\LandLeadResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLandLead extends CreateRecord
{
    protected static string $resource = LandLeadResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['property_id'] = filled($data['property_id'] ?? null) ? $data['property_id'] : null;
        $data['agent_id'] = auth()->guard('agent')->id();
        $data['phone'] = filled($data['phone'] ?? null) ? $data['phone'] : null;
        $data['deal_value'] = filled($data['deal_value'] ?? null) ? $data['deal_value'] : null;
        $data['expected_close_date'] = filled($data['expected_close_date'] ?? null) ? $data['expected_close_date'] : null;
        $data['next_follow_up_at'] = filled($data['next_follow_up_at'] ?? null) ? $data['next_follow_up_at'] : null;
        $data['agent_notes'] = filled($data['agent_notes'] ?? null) ? $data['agent_notes'] : null;

        return $data;
    }
}
