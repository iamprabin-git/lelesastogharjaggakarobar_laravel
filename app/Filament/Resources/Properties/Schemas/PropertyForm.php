<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),

                RichEditor::make('description')
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),

                Select::make('type')
                    ->options([
                        'sale' => 'Sale',
                        'rent' => 'Rent',
                    ])
                    ->default('sale')
                    ->required(),

                // Admin can manually change status, but usually done via table actions
                Select::make('status')
                    ->options([
                        'pending'  => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required(),

                // New field for admin notes (rejection reason, comments)
                Textarea::make('admin_notes')
                    ->label('Admin Notes / Rejection Reason')
                    ->placeholder('Enter any notes or rejection reason')
                    ->rows(3)
                    ->columnSpanFull(),

                Select::make('availability')
                    ->options([
                        'available' => 'Available',
                        'rented'    => 'Rented',
                        'sold'      => 'Sold',
                    ])
                    ->default('available')
                    ->required(),

                TextInput::make('bedrooms')
                    ->numeric(),

                TextInput::make('bathrooms')
                    ->numeric(),

                TextInput::make('area')
                    ->numeric(),

                TextInput::make('location'),
                TextInput::make('city'),
                TextInput::make('state'),
                TextInput::make('country'),

                // Consider replacing with FileUpload for images
                Textarea::make('images')
                    ->label('Image paths (JSON or comma-separated)')
                    ->columnSpanFull(),

                TextInput::make('youtube_link'),

                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),

                Select::make('agent_id')
                    ->relationship('agent', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
