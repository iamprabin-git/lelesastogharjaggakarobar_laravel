<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('position')
                    ->required()
                    ->maxLength(255),
                Textarea::make('bio')
                    ->rows(3),
                FileUpload::make('photo')
                    ->image()
                    ->directory('team_members')
                    ->required(),
                TextInput::make('email')->email()->unique(ignoreRecord: true),
                TextInput::make('phone')->tel(),
                TextInput::make('facebook')->url(),
                TextInput::make('instagram')->url(),
                TextInput::make('whatsapp')->tel(),
                TextInput::make('tiktok')->url(),
                TextInput::make('linkedin')->url(),
                Toggle::make('is_active')->default(true),
            ]);
    }
}
