<?php

namespace App\Filament\Resources\PropertyReviews;

use App\Filament\Resources\PropertyReviews\Pages\EditPropertyReview;
use App\Filament\Resources\PropertyReviews\Pages\ListPropertyReviews;
use App\Filament\Resources\PropertyReviews\Schemas\PropertyReviewForm;
use App\Filament\Resources\PropertyReviews\Tables\PropertyReviewsTable;
use App\Models\PropertyReview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PropertyReviewResource extends Resource
{
    protected static ?string $model = PropertyReview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $navigationLabel = 'Property reviews';

    protected static ?string $modelLabel = 'Property review';

    protected static ?string $pluralModelLabel = 'Property reviews';

    protected static string|UnitEnum|null $navigationGroup = 'Reviews';

    protected static ?int $navigationSort = 10;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return PropertyReviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropertyReviewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPropertyReviews::route('/'),
            'edit' => EditPropertyReview::route('/{record}/edit'),
        ];
    }
}
