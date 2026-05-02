<?php

namespace App\Filament\Resources\MonthlySpotlights\Tables;

use App\Models\MonthlySpotlight;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MonthlySpotlightsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kind')
                    ->label('Type')
                    ->formatStateUsing(function (string $state): string {
                        $labels = MonthlySpotlight::kindLabels();

                        return $labels[$state] ?? $state;
                    })
                    ->sortable(),
                TextColumn::make('honoree_name')
                    ->label('Name')
                    ->searchable(),
                TextColumn::make('period_label')
                    ->label('Period')
                    ->toggleable(),
                IconColumn::make('is_published')
                    ->boolean()
                    ->label('Live'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('kind')
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
