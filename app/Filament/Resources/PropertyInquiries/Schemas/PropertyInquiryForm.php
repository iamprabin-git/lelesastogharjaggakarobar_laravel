<?php

namespace App\Filament\Resources\PropertyInquiries\Schemas;

use App\Crm\CrmLeadStage;
use App\Crm\LeadSource;
use App\Crm\LostReason;
use App\Models\Property;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class PropertyInquiryForm
{
    public static function configureCreate(Schema $schema, bool $forAgent = false): Schema
    {
        $propertySelect = Select::make('property_id')
            ->relationship(
                name: 'property',
                titleAttribute: 'title',
                modifyQueryUsing: fn ($query) => $query
                    ->whereNotNull('agent_id')
                    ->when($forAgent, fn ($q) => $q->where('agent_id', Auth::guard('agent')->id()))
                    ->orderBy('title'),
            )
            ->label('Listing / plot')
            ->helperText('Leave empty for a general lead (walk-in, referral, no specific plot yet).')
            ->searchable()
            ->preload()
            ->live()
            ->placeholder('— General / no specific listing —');

        if ($forAgent) {
            $propertySelect->afterStateUpdated(function (Set $set, ?string $state): void {
                $set('agent_id', Auth::guard('agent')->id());
            });
        } else {
            $propertySelect->afterStateUpdated(function (Set $set, ?string $state): void {
                if (! $state) {
                    $set('agent_id', null);

                    return;
                }
                $set('agent_id', Property::query()->whereKey($state)->value('agent_id'));
            });
        }

        $components = [
            $propertySelect,
        ];

        if ($forAgent) {
            $components[] = Hidden::make('agent_id')
                ->default(fn () => Auth::guard('agent')->id())
                ->required();
        } else {
            $components[] = Select::make('agent_id')
                ->relationship('agent', 'name')
                ->label('Assigned agent')
                ->searchable()
                ->preload()
                ->required()
                ->helperText('Filled from the listing by default; change if another agent owns the sale.');
        }

        $components = array_merge($components, [
            TextInput::make('name')
                ->label('Customer / buyer name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),

            TextInput::make('phone')
                ->label('Phone')
                ->tel()
                ->maxLength(32),

            Select::make('lead_source')
                ->label('Lead source')
                ->options(LeadSource::options())
                ->default(LeadSource::CRM_MANUAL)
                ->required()
                ->native(false),

            Textarea::make('message')
                ->label('Initial note')
                ->helperText('What they want, budget, timeline, how you reached them, etc.')
                ->rows(4)
                ->required()
                ->columnSpanFull(),

            Select::make('crm_status')
                ->label('Pipeline stage')
                ->options(CrmLeadStage::options())
                ->default(CrmLeadStage::NEW)
                ->required()
                ->native(false),

            TextInput::make('deal_value')
                ->label('Deal value (estimate)')
                ->numeric()
                ->prefix('Rs. ')
                ->default(null),

            DatePicker::make('expected_close_date')
                ->label('Expected close date')
                ->native(false),

            DateTimePicker::make('next_follow_up_at')
                ->label('Next follow-up')
                ->seconds(false)
                ->native(false),

            Toggle::make('is_read')
                ->label('Marked as read')
                ->default(false),

            Textarea::make('agent_notes')
                ->label('Agent activity log')
                ->rows(3)
                ->columnSpanFull(),
        ]);

        if (! $forAgent) {
            $components[] = Textarea::make('admin_notes')
                ->label('Admin-only notes')
                ->rows(3)
                ->columnSpanFull();
        }

        return $schema->components($components);
    }

    public static function configure(Schema $schema, bool $forAgent = false): Schema
    {
        $components = [
            Select::make('property_id')
                ->relationship('property', 'title')
                ->label('Listing / plot')
                ->disabled()
                ->dehydrated(false)
                ->placeholder('— General lead (no listing) —'),

            Select::make('agent_id')
                ->relationship('agent', 'name')
                ->label('Assigned agent')
                ->disabled()
                ->dehydrated(false)
                ->hidden($forAgent),

            TextInput::make('name')
                ->label('Buyer name')
                ->disabled()
                ->dehydrated(false),

            TextInput::make('email')
                ->email()
                ->disabled()
                ->dehydrated(false),

            TextInput::make('phone')
                ->label('Phone')
                ->tel()
                ->disabled()
                ->dehydrated(false),

            Select::make('lead_source')
                ->label('Lead source')
                ->options(LeadSource::options())
                ->placeholder('Select source')
                ->native(false),

            Textarea::make('message')
                ->label('Buyer message')
                ->disabled()
                ->dehydrated(false)
                ->rows(4)
                ->columnSpanFull(),

            Select::make('crm_status')
                ->label('Pipeline stage')
                ->options(CrmLeadStage::options())
                ->required()
                ->native(false),

            Select::make('lost_reason')
                ->label('Loss reason')
                ->options(LostReason::options())
                ->visible(fn (Get $get): bool => $get('crm_status') === CrmLeadStage::CLOSED_LOST)
                ->native(false),

            TextInput::make('deal_value')
                ->label('Deal value (estimate)')
                ->numeric()
                ->prefix('Rs. ')
                ->helperText('Expected plot / land deal size for forecasting.')
                ->default(null),

            DatePicker::make('expected_close_date')
                ->label('Expected close date')
                ->native(false),

            DateTimePicker::make('next_follow_up_at')
                ->label('Next follow-up')
                ->seconds(false)
                ->native(false),

            Toggle::make('is_read')
                ->label('Marked as read'),

            Textarea::make('agent_notes')
                ->label('Agent activity log')
                ->helperText('Site visits, calls, boundary checks, title follow-ups.')
                ->rows(4)
                ->columnSpanFull(),
        ];

        if (! $forAgent) {
            $components[] = Textarea::make('admin_notes')
                ->label('Admin-only notes')
                ->helperText('Not shown to agents.')
                ->rows(4)
                ->columnSpanFull();
        }

        return $schema->components($components);
    }
}
