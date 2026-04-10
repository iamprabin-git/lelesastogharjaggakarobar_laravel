<?php

namespace App\Filament\Resources\Conversations\Tables;

use App\Models\Conversation;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ConversationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('needs_reply')
                    ->label('')
                    ->boolean()
                    ->getStateUsing(fn (Conversation $record): bool => $record->unreadMessagesForAdmin() > 0)
                    ->trueIcon('heroicon-o-envelope')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('warning')
                    ->falseColor('gray'),
                TextColumn::make('user.name')
                    ->label('Member')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('subject')
                    ->placeholder('Support')
                    ->limit(40),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === Conversation::STATUS_OPEN ? 'Open' : 'Closed')
                    ->color(fn (string $state): string => $state === Conversation::STATUS_OPEN ? 'success' : 'gray'),
                TextColumn::make('last_message_at')
                    ->label('Last message')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        Conversation::STATUS_OPEN => 'Open',
                        Conversation::STATUS_CLOSED => 'Closed',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->defaultSort('last_message_at', 'desc');
    }
}
