<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Symfony\Component\HttpFoundation\File\File;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('title')
                ->required(),

                FileUpload::make('thumbnail')
                ->image()
                ->disk('public')
                ->visibility('public'),
                
                Select::make('techStacks')
                ->relationship('techStacks', 'tech_name')
                ->multiple()
                ->preload()
                ->searchable()
                ->required(),
                
                Select::make('status')
                ->options([
                    'deployed' => 'Deployed',
                    'undeployed' => 'Un Deployed',
                    'on progres' => 'On Progres',
                    ])
                ->required(),

                TextInput::make("url_github"),
                TextInput::make('url_site'),

                RichEditor::make('description'),

                Repeater::make('photos')
                    ->relationship('photos')
                    ->schema([
                        FileUpload::make('url_image')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->required(),
                    ]),
            ]);
    }
}
