<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('author')
                    ->maxLength(100),
                Textarea::make('excerpt')
                    ->maxLength(500),
                RichEditor::make('content')
                    ->required(),
                FileUpload::make('image')
                    ->directory('blogs')
                    ->image(),
                Toggle::make('is_published')
                    ->label('Published')
                    ->default(true),
            ]);
    }
}
