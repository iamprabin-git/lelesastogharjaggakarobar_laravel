<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class CompanyForm
{
    public static function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->email(),

            TextInput::make('phone'),

            Textarea::make('address'),

            FileUpload::make('logo')
                ->image()
                ->directory('companies')
                ->label('Company Logo'),

            TextInput::make('facebook')->url(),
            TextInput::make('viber')->url(),
            TextInput::make('whatsapp')->url(),
            TextInput::make('youtube')->url(),
            TextInput::make('instagram')->url(),
            TextInput::make('tiktok')->url(),

            ColorPicker::make('primary_color')->label('Primary Color'),
            ColorPicker::make('secondary_color')->label('Secondary Color'),
            ColorPicker::make('primary_background_color')->label('PrimaryBackground Color'),
            ColorPicker::make('secondary_background_color')->label('Secondary Background Color'),
            ColorPicker::make('primary_text_color')->label('Primary Text Color'),
            ColorPicker::make('secondary_text_color')->label('Secondary Text Color'),

            Toggle::make('status')->label('Active')->default(true),
        ];
    }
}
