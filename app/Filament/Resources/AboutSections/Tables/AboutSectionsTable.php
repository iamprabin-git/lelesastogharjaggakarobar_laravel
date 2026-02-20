<?php

namespace App\Filament\Resources\AboutSections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AboutSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('hero_title')->sortable()->searchable(),
                ImageColumn::make('hero_image'),
                TextColumn::make('experience_years'),
                TextColumn::make('properties_sold'),
                TextColumn::make('happy_clients'),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
