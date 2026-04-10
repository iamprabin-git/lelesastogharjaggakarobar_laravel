<?php

namespace App\Filament\Resources\Conversations\Pages;

use App\Filament\Resources\Conversations\ConversationResource;
use App\Models\Conversation;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class ViewConversation extends ViewRecord
{
    protected static string $resource = ConversationResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        /** @var Conversation $model */
        $model = $this->getRecord();
        $model->update(['admin_last_read_at' => now()]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('close')
                ->label('Close thread')
                ->icon(Heroicon::OutlinedLockClosed)
                ->visible(fn (): bool => $this->getRecord()->status === Conversation::STATUS_OPEN)
                ->requiresConfirmation()
                ->action(fn () => $this->getRecord()->update(['status' => Conversation::STATUS_CLOSED])),
            Action::make('reopen')
                ->label('Reopen thread')
                ->icon(Heroicon::OutlinedLockOpen)
                ->visible(fn (): bool => $this->getRecord()->status === Conversation::STATUS_CLOSED)
                ->action(fn () => $this->getRecord()->update(['status' => Conversation::STATUS_OPEN])),
        ];
    }
}
