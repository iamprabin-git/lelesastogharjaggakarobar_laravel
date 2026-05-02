<?php

namespace App\Filament\Resources\MonthlySpotlights;

use App\Filament\Resources\MonthlySpotlights\Pages\CreateMonthlySpotlight;
use App\Filament\Resources\MonthlySpotlights\Pages\EditMonthlySpotlight;
use App\Filament\Resources\MonthlySpotlights\Pages\ListMonthlySpotlights;
use App\Filament\Resources\MonthlySpotlights\Schemas\MonthlySpotlightForm;
use App\Filament\Resources\MonthlySpotlights\Tables\MonthlySpotlightsTable;
use App\Models\MonthlySpotlight;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MonthlySpotlightResource extends Resource
{
    protected static ?string $model = MonthlySpotlight::class;

    protected static ?string $navigationLabel = 'Monthly spotlights';

    protected static ?string $modelLabel = 'spotlight';

    protected static ?string $pluralModelLabel = 'Monthly spotlights';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?int $navigationSort = 27;

    protected static ?string $recordTitleAttribute = 'honoree_name';

    public static function form(Schema $schema): Schema
    {
        return MonthlySpotlightForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MonthlySpotlightsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMonthlySpotlights::route('/'),
            'create' => CreateMonthlySpotlight::route('/create'),
            'edit' => EditMonthlySpotlight::route('/{record}/edit'),
        ];
    }
}
