<?php

namespace App\Filament\Resources\AboutServices\Schemas;

use App\Support\AboutServiceIcons;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AboutServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->required()
                    ->rows(4),

                Select::make('icon')
                    ->label('Icon')
                    ->options(AboutServiceIcons::options())
                    ->default(AboutServiceIcons::default())
                    ->required()
                    ->searchable(),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Toggle::make('is_active')
                    ->label('Visible on website')
                    ->default(true),
            ]);
    }
}
