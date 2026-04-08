<?php

namespace App\Filament\Resources\PropertyInquiries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PropertyInquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('property_id')
                    ->relationship('property', 'title')
                    ->label('Property')
                    ->disabled()
                    ->dehydrated(false),

                Select::make('agent_id')
                    ->relationship('agent', 'name')
                    ->label('Agent')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('name')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('email')
                    ->email()
                    ->disabled()
                    ->dehydrated(false),

                Textarea::make('message')
                    ->disabled()
                    ->dehydrated(false)
                    ->rows(5)
                    ->columnSpanFull(),

                Toggle::make('is_read')
                    ->label('Marked as read'),

                Select::make('crm_status')
                    ->label('Pipeline stage')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'qualified' => 'Qualified',
                        'closed_won' => 'Closed — won',
                        'closed_lost' => 'Closed — lost',
                    ])
                    ->required(),

                Textarea::make('admin_notes')
                    ->label('Internal notes')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}
