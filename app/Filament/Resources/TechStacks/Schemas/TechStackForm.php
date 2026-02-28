<?php

namespace App\Filament\Resources\TechStacks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TechStackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tech_name')
                ->required(),
                FileUpload::make('url_image_tech')
                ->image()
                ->label('Image')
                ->disk('public')
                ->visibility('public')
                ->required(),
            ]);
    }
}
