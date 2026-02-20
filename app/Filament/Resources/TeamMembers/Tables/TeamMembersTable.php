<?php

namespace App\Filament\Resources\TeamMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class TeamMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('position')->sortable()->searchable(),
                ImageColumn::make('photo')
                    ->disk('public')
                    ->url(fn($record) => $record->photo ? asset('storage/' . $record->photo) : null)
                    ->label('Photo'),
                TextColumn::make('facebook')->url(fn($record) => $record->facebook)->openUrlInNewTab(),
                TextColumn::make('instagram')->url(fn($record) => $record->instagram)->openUrlInNewTab(),
                TextColumn::make('linkedin')->url(fn($record) => $record->linkedin)->openUrlInNewTab(),
                TextColumn::make('email')->url(fn($record) => $record->email)->openUrlInNewTab(),
                TextColumn::make('phone')->url(fn($record) => $record->phone)->openUrlInNewTab(),
                ToggleColumn::make('is_active')->label('Active')->sortable()->alignCenter(),
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
