<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('email')
                    ->email()
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('phone')
                    ->label('Phone')
                    ->disabled()
                    ->dehydrated(false),
                Textarea::make('message')
                    ->disabled()
                    ->dehydrated(false)
                    ->rows(10)
                    ->columnSpanFull(),
                Toggle::make('is_read')
                    ->label('Marked as read'),
            ]);
    }
}
