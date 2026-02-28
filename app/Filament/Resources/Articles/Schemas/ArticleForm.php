<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Article Information')
                ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Select::make('categories')
                            ->relationship('categories', 'category_name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->required(),

                        FileUpload::make('url_thumbnail')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->required(),

                        Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published'
                        ])
                        ->required(),

                        RichEditor::make('content'),
                ])
                ->columns(1),
            ]);
    }
}
