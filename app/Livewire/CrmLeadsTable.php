<?php

namespace App\Livewire;

use App\Filament\Resources\Properties\PropertyResource;
use App\Filament\Resources\PropertyInquiries\PropertyInquiryResource;
use App\Models\PropertyInquiry;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CrmLeadsTable extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => PropertyInquiry::query()->with(['property', 'agent']))
            ->poll('30s')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (PropertyInquiry $record): ?string => $record->email),
                TextColumn::make('property.title')
                    ->label('Property')
                    ->limit(40)
                    ->sortable()
                    ->url(fn (PropertyInquiry $record): ?string => $record->property
                        ? PropertyResource::getUrl('edit', ['record' => $record->property])
                        : null),
                TextColumn::make('agent.name')
                    ->label('Agent')
                    ->sortable(),
                TextColumn::make('message')
                    ->label('Message')
                    ->limit(50)
                    ->tooltip(fn (PropertyInquiry $record): string => $record->message)
                    ->wrap(),
                TextColumn::make('crm_status')
                    ->label('Stage')
                    ->badge()
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
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'qualified' => 'Qualified',
                        'closed_won' => 'Closed — won',
                        'closed_lost' => 'Closed — lost',
                    ]),
                SelectFilter::make('is_read')
                    ->options([
                        '1' => 'Read',
                        '0' => 'Unread',
                    ]),
            ])
            ->recordActions([
                Action::make('manage')
                    ->label('Lead')
                    ->icon(Heroicon::OutlinedPencilSquare)
                    ->url(fn (PropertyInquiry $record): string => PropertyInquiryResource::getUrl('edit', ['record' => $record])),
                Action::make('email')
                    ->label('Email')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->url(function (PropertyInquiry $record): string {
                        $subject = 'Re: '.($record->property?->title ?? 'Property inquiry');

                        return 'mailto:'.rawurlencode($record->email)
                            .'?subject='.rawurlencode($subject)
                            .'&body='.rawurlencode("Hi {$record->name},\n\nRegarding your inquiry:\n{$record->message}\n\n");
                    })
                    ->openUrlInNewTab(),
                Action::make('listing')
                    ->label('Public listing')
                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                    ->visible(fn (PropertyInquiry $record): bool => $record->property !== null
                        && $record->property->status === 'approved'
                        && $record->property->availability === 'available')
                    ->url(fn (PropertyInquiry $record): string => route('properties.show', $record->property))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('mark_read')
                        ->label('Mark read')
                        ->icon(Heroicon::OutlinedEnvelopeOpen)
                        ->action(function (Collection $records): void {
                            $records->each(fn (PropertyInquiry $r) => $r->update(['is_read' => true]));
                        }),
                    BulkAction::make('mark_unread')
                        ->label('Mark unread')
                        ->icon(Heroicon::OutlinedEnvelope)
                        ->action(function (Collection $records): void {
                            $records->each(fn (PropertyInquiry $r) => $r->update(['is_read' => false]));
                        }),
                    BulkAction::make('set_stage')
                        ->label('Move to stage')
                        ->icon(Heroicon::OutlinedArrowPath)
                        ->schema([
                            Select::make('crm_status')
                                ->label('Pipeline stage')
                                ->options([
                                    'new' => 'New',
                                    'contacted' => 'Contacted',
                                    'qualified' => 'Qualified',
                                    'closed_won' => 'Closed — won',
                                    'closed_lost' => 'Closed — lost',
                                ])
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $records->each(fn (PropertyInquiry $r) => $r->update([
                                'crm_status' => $data['crm_status'],
                            ]));
                        }),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public function render(): View
    {
        return view('livewire.crm-leads-table');
    }
}
