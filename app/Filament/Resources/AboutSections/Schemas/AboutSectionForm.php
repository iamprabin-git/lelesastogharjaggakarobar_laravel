<?php

namespace App\Filament\Resources\AboutSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AboutSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               TextInput::make('hero_title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('hero_description')
                    ->required(),

                FileUpload::make('hero_image')
                    ->image()
                    ->directory('about/hero'),

                FileUpload::make('about_image')
                    ->image()
                    ->directory('about/about'),

                TextInput::make('experience_years')
                    ->label('Experience (years)')
                    ->required(),

                TextInput::make('properties_sold')
                    ->required()
                    ->numeric(),

                TextInput::make('happy_clients')
                    ->required()
                    ->numeric(),

                RichEditor::make('mission')
                    ->required(),

                RichEditor::make('vision')
                    ->required(),
            ]);
    }
}
