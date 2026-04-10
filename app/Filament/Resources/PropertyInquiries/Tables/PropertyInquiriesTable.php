<?php

namespace App\Filament\Resources\PropertyInquiries\Tables;

use App\Crm\CrmLeadStage;
use App\Crm\LeadSource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PropertyInquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Buyer')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record): ?string => $record->email),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('property.title')
                    ->label('Land / listing')
                    ->placeholder('— General lead')
                    ->limit(32)
                    ->sortable(),
                TextColumn::make('property.area')
                    ->label('Area')
                    ->placeholder('—')
                    ->suffix(' sq.ft')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('property.location')
                    ->label('Location')
                    ->placeholder('—')
                    ->limit(24)
                    ->toggleable(),
                TextColumn::make('agent.name')
                    ->label('Agent')
                    ->sortable(),
                TextColumn::make('lead_source')
                    ->label('Source')
                    ->formatStateUsing(fn (?string $state): string => LeadSource::label($state))
                    ->badge()
                    ->color('gray')
                    ->toggleable(),
                TextColumn::make('deal_value')
                    ->label('Deal (est.)')
                    ->money('NPR')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('expected_close_date')
                    ->label('Target close')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('next_follow_up_at')
                    ->label('Follow-up')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('crm_status')
                    ->label('Stage')
                    ->formatStateUsing(fn (?string $state): string => CrmLeadStage::label($state))
                    ->badge()
                    ->color(fn (?string $state): string => CrmLeadStage::color($state))
                    ->sortable(),
                IconColumn::make('is_read')
                    ->label('Read')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('crm_status')
                    ->label('Stage')
                    ->options(CrmLeadStage::options()),
                SelectFilter::make('lead_source')
                    ->options(LeadSource::options()),
                SelectFilter::make('is_read')
                    ->options([
                        '1' => 'Read',
                        '0' => 'Unread',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
