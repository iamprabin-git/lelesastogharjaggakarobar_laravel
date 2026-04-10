<?php

namespace App\Filament\Resources\PropertyInquiries;

use App\Filament\Resources\PropertyInquiries\Pages\CreatePropertyInquiry;
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

    protected static ?string $modelLabel = 'Land lead';

    protected static ?string $pluralModelLabel = 'Land sales leads';

    protected static string|UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        if ($schema->getOperation() === 'create') {
            return PropertyInquiryForm::configureCreate($schema, forAgent: false);
        }

        return PropertyInquiryForm::configure($schema, forAgent: false);
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
            'create' => CreatePropertyInquiry::route('/create'),
            'edit' => EditPropertyInquiry::route('/{record}/edit'),
        ];
    }
}
