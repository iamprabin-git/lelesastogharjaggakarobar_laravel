<?php

namespace App\Filament\Resources\Properties\Tables;

use App\Models\Property;
use App\Notifications\PropertyApproved;
use App\Notifications\PropertyRejected;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // Eager load agent relationship to avoid N+1 queries
            ->modifyQueryUsing(fn (Builder $query) => $query->with('agent'))

            // Columns
            ->columns([
                TextColumn::make('title')
                    ->label('Property Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(fn ($state) => $state),

                TextColumn::make('agent.name')
                    ->label('Agent')
                    ->searchable(query: function (Builder $query, string $search) {
                        $query->orWhereHas('agent', fn ($q) => $q->where('name', 'like', "%{$search}%"));
                    })
                    ->sortable(),

                IconColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger'  => 'rejected',
                    ])
                    ->icons([
                        'heroicon-o-clock'          => 'pending',
                        'heroicon-o-check-circle'   => 'approved',
                        'heroicon-o-x-circle'       => 'rejected',
                    ])
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->money('NPR')
                    ->sortable(),

                // Show rejection reason only when status is rejected
                TextColumn::make('admin_notes')
                    ->label('Rejection Reason')
                    ->visible(fn ($record) => optional($record)->status === 'rejected')
                    ->limit(30)
                    ->tooltip(fn ($state) => $state),

                TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            // Filters
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Pending Approval',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->multiple()
                    ->placeholder('All statuses'),

                SelectFilter::make('agent_id')
                    ->label('Agent')
                    ->relationship('agent', 'name')
                    ->searchable()
                    ->preload(),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->label('Submitted from'),
                        DatePicker::make('created_until')->label('Submitted until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_from'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])

            // Default to showing only pending properties (admins can change filter)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))

            // Row actions
            ->actions([
                ViewAction::make()
                    ->label('View Details')
                    ->icon('heroicon-o-eye'),

                EditAction::make(),

                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Property $record) => $record->status !== 'approved')
                    ->action(function (Property $record) {
                        $record->update(['status' => 'approved']);
                        // Notify the agent
                        $record->agent->notify(new PropertyApproved($record));
                        Notification::make()
                            ->success()
                            ->title('Property approved')
                            ->body('The agent has been notified.')
                            ->send();
                    }),

                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label('Reason for rejection')
                            ->rows(3)
                            ->required(),
                    ])
                    ->action(function (Property $record, array $data) {
                        $record->update([
                            'status'      => 'rejected',
                            'admin_notes' => $data['rejection_reason'],
                        ]);
                        $record->agent->notify(new PropertyRejected($record, $data['rejection_reason']));
                        Notification::make()
                            ->danger()
                            ->title('Property rejected')
                            ->body('The agent has been notified.')
                            ->send();
                    }),
            ])

            // Bulk actions
            ->bulkActions([
                BulkAction::make('approve_selected')
                    ->label('Approve Selected')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function ($records) {
                        $records->each(function ($record) {
                            $record->update(['status' => 'approved']);
                            $record->agent->notify(new PropertyApproved($record));
                        });
                        Notification::make()
                            ->success()
                            ->title('Selected properties approved')
                            ->body('Agents have been notified.')
                            ->send();
                    }),

                BulkAction::make('reject_selected')
                    ->label('Reject Selected')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('reason')
                            ->label('Rejection reason (applied to all)')
                            ->rows(3)
                            ->required(),
                    ])
                    ->action(function ($records, array $data) {
                        $records->each(function ($record) use ($data) {
                            $record->update([
                                'status'      => 'rejected',
                                'admin_notes' => $data['reason'],
                            ]);
                            $record->agent->notify(new PropertyRejected($record, $data['reason']));
                        });
                        Notification::make()
                            ->danger()
                            ->title('Selected properties rejected')
                            ->body('Agents have been notified.')
                            ->send();
                    }),
            ])

            // Grouping options
            ->groups([
                Group::make('status')
                    ->getDescriptionFromRecordUsing(fn (Property $record) => ucfirst($record->status))
                    ->collapsible(),
                Group::make('agent.name')
                    ->label('Agent')
                    ->collapsible(),
            ])

            // Default sort & appearance
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->poll('60s')
            ->persistFiltersInSession();
    }
}
