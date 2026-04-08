<?php

namespace App\Filament\Resources\Agents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

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
                    ->required(fn ($record) => $record === null)
                    ->dehydrated(fn ($state) => filled($state)),

                FileUpload::make('avatar')
                    ->image()
                    ->directory('agents')
                    ->disk('public')
                    ->nullable(),

                DatePicker::make('expiry_date')
                    ->nullable(),

                Toggle::make('status')
                    ->label('Active (approved)')
                    ->helperText('Turn on after you approve a frontend registration (or use Approve on the list). Active agents can open /agent/login and create property listings.')
                    ->default(false),

                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->nullable(),

                TextInput::make('facebook')->url()->nullable()->maxLength(255),
                TextInput::make('twitter')->url()->nullable()->maxLength(255),
                TextInput::make('linkedin')->url()->nullable()->maxLength(255),
                TextInput::make('instagram')->url()->nullable()->maxLength(255),

            ]);
    }
}
