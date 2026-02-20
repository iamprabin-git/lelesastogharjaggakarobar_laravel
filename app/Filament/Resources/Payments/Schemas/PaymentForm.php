<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('status')
    ->options([
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
    ])
    ->required(),
            ]);
    }
}
