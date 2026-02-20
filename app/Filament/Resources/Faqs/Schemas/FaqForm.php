<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label('Question')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('answer')
                    ->label('Answer')
                    ->required()
                    ->maxLength(1000),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]);
    }
}
