<?php

namespace App\Filament\Resources\PropertyInquiries\Pages;

use App\Filament\Resources\PropertyInquiries\PropertyInquiryResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePropertyInquiry extends CreateRecord
{
    protected static string $resource = PropertyInquiryResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['property_id'] = filled($data['property_id'] ?? null) ? $data['property_id'] : null;
        $data['phone'] = filled($data['phone'] ?? null) ? $data['phone'] : null;
        $data['deal_value'] = filled($data['deal_value'] ?? null) ? $data['deal_value'] : null;
        $data['expected_close_date'] = filled($data['expected_close_date'] ?? null) ? $data['expected_close_date'] : null;
        $data['next_follow_up_at'] = filled($data['next_follow_up_at'] ?? null) ? $data['next_follow_up_at'] : null;
        $data['agent_notes'] = filled($data['agent_notes'] ?? null) ? $data['agent_notes'] : null;
        $data['admin_notes'] = filled($data['admin_notes'] ?? null) ? $data['admin_notes'] : null;

        return $data;
    }
}
