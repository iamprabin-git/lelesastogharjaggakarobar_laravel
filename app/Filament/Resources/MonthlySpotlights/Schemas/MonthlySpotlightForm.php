<?php

namespace App\Filament\Resources\MonthlySpotlights\Schemas;

use App\Models\MonthlySpotlight;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MonthlySpotlightForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kind')
                    ->label('Spotlight type')
                    ->options(MonthlySpotlight::kindLabels())
                    ->required()
                    ->native(false)
                    ->disabledOn('edit'),

                TextInput::make('honoree_name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('subtitle')
                    ->maxLength(255)
                    ->placeholder('Short line under the name'),

                TextInput::make('period_label')
                    ->label('Period (optional)')
                    ->maxLength(255)
                    ->placeholder('e.g. May 2026'),

                TextInput::make('page_title')
                    ->label('Custom page title (optional)')
                    ->maxLength(255)
                    ->helperText('Overrides the default “Agent / Buyer of the month” headline.'),

                FileUpload::make('image')
                    ->label('Featured photo')
                    ->image()
                    ->directory('spotlights')
                    ->nullable(),

                RichEditor::make('congratulations_html')
                    ->label('Congratulations message'),

                Toggle::make('is_published')
                    ->label('Published on website')
                    ->default(false),
            ]);
    }
}
