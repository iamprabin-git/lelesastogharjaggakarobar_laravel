<?php

namespace App\Filament\Agent\Resources\Properties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('price')
                ->prefix('Rs')
                    ->sortable(),
                TextColumn::make('type')
                    ->badge(),
                TextColumn::make('location')
                    ->searchable(),

                TextColumn::make('area')
                    ->numeric(),
                TextColumn::make('bedrooms')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('bathrooms')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('amenities.name')
                    ->searchable(),

                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('availability')
                    ->badge(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
