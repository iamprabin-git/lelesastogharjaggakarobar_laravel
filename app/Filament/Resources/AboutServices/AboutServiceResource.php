<?php

namespace App\Filament\Resources\AboutServices;

use App\Filament\Resources\AboutServices\Pages\CreateAboutService;
use App\Filament\Resources\AboutServices\Pages\EditAboutService;
use App\Filament\Resources\AboutServices\Pages\ListAboutServices;
use App\Filament\Resources\AboutServices\Schemas\AboutServiceForm;
use App\Filament\Resources\AboutServices\Tables\AboutServicesTable;
use App\Models\AboutService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AboutServiceResource extends Resource
{
    protected static ?string $model = AboutService::class;

    protected static ?string $navigationLabel = 'About services';

    protected static ?string $modelLabel = 'service';

    protected static ?string $pluralModelLabel = 'services';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Website';

    protected static ?int $navigationSort = 26;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AboutServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutServicesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutServices::route('/'),
            'create' => CreateAboutService::route('/create'),
            'edit' => EditAboutService::route('/{record}/edit'),
        ];
    }
}
