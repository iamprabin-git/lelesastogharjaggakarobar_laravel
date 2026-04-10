<?php

namespace App\Filament\Agent\Resources\LandLeads;

use App\Filament\Agent\Resources\LandLeads\Pages\CreateLandLead;
use App\Filament\Agent\Resources\LandLeads\Pages\EditLandLead;
use App\Filament\Agent\Resources\LandLeads\Pages\ListLandLeads;
use App\Filament\Agent\Resources\LandLeads\Schemas\LandLeadForm;
use App\Filament\Resources\PropertyInquiries\Schemas\PropertyInquiryForm;
use App\Filament\Agent\Resources\LandLeads\Tables\LandLeadsTable;
use App\Models\PropertyInquiry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class LandLeadResource extends Resource
{
    protected static ?string $model = PropertyInquiry::class;

    protected static ?string $navigationLabel = 'Leads & pipeline';

    protected static ?string $modelLabel = 'Lead';

    protected static ?string $pluralModelLabel = 'Land sales leads';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('agent_id', Auth::guard('agent')->id());
    }

    public static function form(Schema $schema): Schema
    {
        if ($schema->getOperation() === 'create') {
            return PropertyInquiryForm::configureCreate($schema, forAgent: true);
        }

        return LandLeadForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LandLeadsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLandLeads::route('/'),
            'create' => CreateLandLead::route('/create'),
            'edit' => EditLandLead::route('/{record}/edit'),
        ];
    }
}
