<?php

namespace App\Filament\Resources\PropertyReviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PropertyReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('property_id')
                    ->relationship('property', 'title')
                    ->label('Property')
                    ->disabled()
                    ->dehydrated(false),

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('rating')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false),

                Textarea::make('comment')
                    ->disabled()
                    ->dehydrated(false)
                    ->rows(5)
                    ->columnSpanFull(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
            ]);
    }
}
