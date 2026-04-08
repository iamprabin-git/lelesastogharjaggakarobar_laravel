<?php

namespace App\Filament\Resources\PropertyInquiries;

use App\Filament\Resources\PropertyInquiries\Pages\EditPropertyInquiry;
use App\Filament\Resources\PropertyInquiries\Pages\ListPropertyInquiries;
use App\Filament\Resources\PropertyInquiries\Schemas\PropertyInquiryForm;
use App\Filament\Resources\PropertyInquiries\Tables\PropertyInquiriesTable;
use App\Models\PropertyInquiry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PropertyInquiryResource extends Resource
{
    protected static ?string $model = PropertyInquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static ?string $navigationLabel = 'Leads & inquiries';

    protected static ?string $modelLabel = 'Lead';

    protected static ?string $pluralModelLabel = 'CRM — leads';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 5;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return PropertyInquiryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropertyInquiriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPropertyInquiries::route('/'),
            'edit' => EditPropertyInquiry::route('/{record}/edit'),
        ];
    }
}
