<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('User'),

                TextInput::make('plan_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->prefix('Rs.'),

                Select::make('payment_method')
                    ->options([
                        'qr' => 'QR',
                        'bank_transfer' => 'Bank transfer',
                    ])
                    ->required(),

                TextInput::make('transaction_id')
                    ->maxLength(255)
                    ->label('Transaction ID'),

                FileUpload::make('screenshot')
                    ->image()
                    ->directory('payments')
                    ->disk('public')
                    ->nullable(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
