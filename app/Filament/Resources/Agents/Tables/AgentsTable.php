<?php

namespace App\Filament\Resources\Agents\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AgentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                ImageColumn::make('avatar')
                    ->disk('public')
                    ->url(fn ($record) => $record->avatar ? asset('storage/'.$record->avatar) : null)
                    ->circular()
                    ->label('Photo'),

                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('phone')->searchable(),

                IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->getStateUsing(fn ($record) => ! is_null($record->email_verified_at)),

                TextColumn::make('expiry_date')
                    ->date()
                    ->sortable()
                    ->color(fn ($record) => $record->expiry_date && $record->expiry_date->isPast() ? 'danger' : 'success'
                    ),

                TextColumn::make('status')
                    ->label('Activation')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'warning')
                    ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Pending approval'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('status')
                    ->label('Activation')
                    ->boolean()
                    ->trueLabel('Active')
                    ->falseLabel('Pending approval')
                    ->default(0),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('approve')
                    ->label('Approve & activate')
                    ->tooltip('Same as turning Active on in Edit: agent can sign in and list properties.')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => ! $record->isActive())
                    ->action(fn ($record) => $record->update([
                        'status' => true,
                        'email_verified_at' => $record->email_verified_at ?? now(),
                    ])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('approvePending')
                        ->label('Approve pending')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalDescription('Only agents that are still pending approval will be activated.')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records): void {
                            $records
                                ->filter(fn ($record) => ! $record->isActive())
                                ->each(fn ($record) => $record->update([
                                    'status' => true,
                                    'email_verified_at' => $record->email_verified_at ?? now(),
                                ]));
                        })
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
