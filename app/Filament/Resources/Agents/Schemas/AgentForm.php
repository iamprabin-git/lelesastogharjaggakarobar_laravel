<?php

namespace App\Filament\Resources\Agents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class AgentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),

                TextInput::make('phone')
                    ->tel()
                    ->maxLength(20),

                TextInput::make('password')
                    ->password()
                    ->required(fn ($record) => $record === null) // required only on create
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state)),

                FileUpload::make('avatar')
                    ->image()
                    ->directory('agents')
                    ->disk('public')
                    ->nullable(),

                DatePicker::make('expiry_date')
                    ->nullable(),

                Toggle::make('status')
                    ->label('Active Status')
                    ->default(1),

                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->nullable(),

            ]);
    }
}
