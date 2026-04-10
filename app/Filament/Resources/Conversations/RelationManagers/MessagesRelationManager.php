<?php

namespace App\Filament\Resources\Conversations\RelationManagers;

use App\Models\Admin;
use App\Models\ConversationMessage;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MessagesRelationManager extends RelationManager
{
    protected static string $relationship = 'messages';

    protected static ?string $title = 'Messages';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('body')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('body')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('sender_label')
                    ->label('From')
                    ->state(function (ConversationMessage $record): string {
                        return $record->sender_type === Admin::class ? 'Staff' : 'Member';
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Reply')
                    ->mutateFormDataUsing(function (array $data): array {
                        /** @var Admin $admin */
                        $admin = Filament::auth()->user();

                        $data['sender_type'] = Admin::class;
                        $data['sender_id'] = $admin->getKey();

                        return $data;
                    }),
            ])
            ->defaultSort('id', 'asc');
    }
}
