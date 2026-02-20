<?php

namespace App\Filament\Agent\Resources\Properties;

use App\Filament\Agent\Resources\Properties\Pages\CreateProperty;
use App\Filament\Agent\Resources\Properties\Pages\EditProperty;
use App\Filament\Agent\Resources\Properties\Pages\ListProperties;
use App\Filament\Agent\Resources\Properties\Schemas\PropertyForm;
use App\Filament\Agent\Resources\Properties\Tables\PropertiesTable;
use App\Models\Property;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('agent_id', Auth::guard('agent')->user()->id);
    }

    public static function form(Schema $schema): Schema
    {
        return PropertyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropertiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProperties::route('/'),
            'create' => CreateProperty::route('/create'),
            'edit' => EditProperty::route('/{record}/edit'),
        ];
    }
}
