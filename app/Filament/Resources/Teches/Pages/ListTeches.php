<?php

namespace App\Filament\Resources\Teches\Pages;

use App\Filament\Resources\Teches\TechResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTeches extends ListRecords
{
    protected static string $resource = TechResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
