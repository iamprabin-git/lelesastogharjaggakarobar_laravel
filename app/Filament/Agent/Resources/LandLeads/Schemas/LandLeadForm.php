<?php

namespace App\Filament\Agent\Resources\LandLeads\Schemas;

use App\Filament\Resources\PropertyInquiries\Schemas\PropertyInquiryForm;
use Filament\Schemas\Schema;

class LandLeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return PropertyInquiryForm::configure($schema, forAgent: true);
    }
}
