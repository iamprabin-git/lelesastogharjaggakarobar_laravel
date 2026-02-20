<?php

namespace App\Filament\Resources\AboutSections;

use App\Filament\Resources\AboutSections\Pages\CreateAboutSection;
use App\Filament\Resources\AboutSections\Pages\EditAboutSection;
use App\Filament\Resources\AboutSections\Pages\ListAboutSections;
use App\Filament\Resources\AboutSections\Schemas\AboutSectionForm;
use App\Filament\Resources\AboutSections\Tables\AboutSectionsTable;
use App\Models\AboutSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutSectionResource extends Resource
{
    protected static ?string $model = AboutSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'about';

    public static function form(Schema $schema): Schema
    {
        return AboutSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutSectionsTable::configure($table);
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
            'index' => ListAboutSections::route('/'),
            'create' => CreateAboutSection::route('/create'),
            'edit' => EditAboutSection::route('/{record}/edit'),
        ];
    }
}
