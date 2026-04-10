<?php

namespace App\Livewire;

use App\Crm\CrmLeadStage;
use App\Crm\LeadSource;
use App\Filament\Agent\Resources\LandLeads\LandLeadResource;
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

    public ?int $scopedAgentId = null;

    public function mount(?int $scopedAgentId = null): void
    {
        $this->scopedAgentId = $scopedAgentId;
    }

    protected function inquiryEditUrl(PropertyInquiry $record): string
    {
        if ($this->scopedAgentId !== null) {
            return LandLeadResource::getUrl('edit', ['record' => $record]);
        }

        return PropertyInquiryResource::getUrl('edit', ['record' => $record]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function (): Builder {
                $query = PropertyInquiry::query()->with(['property', 'agent']);

                if ($this->scopedAgentId !== null) {
                    $query->where('agent_id', $this->scopedAgentId);
                }

                return $query;
            })
            ->poll('30s')
            ->columns([
                TextColumn::make('name')
                    ->label('Buyer')
                    ->searchable()
                    ->sortable()
                    ->description(fn (PropertyInquiry $record): ?string => $record->email),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('property.title')
                    ->label('Land / listing')
                    ->placeholder('— General lead')
                    ->limit(40)
                    ->sortable()
                    ->url(fn (PropertyInquiry $record): ?string => $record->property
                        ? PropertyResource::getUrl('edit', ['record' => $record->property])
                        : null),
                TextColumn::make('property.area')
                    ->label('Plot area')
                    ->placeholder('—')
                    ->suffix(' sq.ft')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('agent.name')
                    ->label('Agent')
                    ->sortable()
                    ->visible(fn (): bool => $this->scopedAgentId === null),
                TextColumn::make('lead_source')
                    ->label('Source')
                    ->formatStateUsing(fn (?string $state): string => LeadSource::label($state))
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deal_value')
                    ->label('Deal (est.)')
                    ->money('NPR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('expected_close_date')
                    ->label('Target close')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('next_follow_up_at')
                    ->label('Follow-up')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('crm_status')
                    ->label('Stage')
                    ->formatStateUsing(fn (?string $state): string => CrmLeadStage::label($state))
                    ->badge()
                    ->color(fn (?string $state): string => CrmLeadStage::color($state))
                    ->sortable(),
                TextColumn::make('message')
                    ->label('Message')
                    ->limit(50)
                    ->tooltip(fn (PropertyInquiry $record): string => $record->message)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Action::make('manage')
                    ->label('Open lead')
                    ->icon(Heroicon::OutlinedPencilSquare)
                    ->url(fn (PropertyInquiry $record): string => $this->inquiryEditUrl($record)),
                Action::make('email')
                    ->label('Email')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->url(function (PropertyInquiry $record): string {
                        $subject = 'Re: '.($record->property?->title ?? 'General land inquiry');

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
                                ->options(CrmLeadStage::options())
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $records->each(fn (PropertyInquiry $r) => $r->update([
                                'crm_status' => $data['crm_status'],
                            ]));
                        }),
                    DeleteBulkAction::make()
                        ->visible(fn (): bool => $this->scopedAgentId === null),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public function render(): View
    {
        return view('livewire.crm-leads-table');
    }
}
