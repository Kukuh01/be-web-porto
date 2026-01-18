<?php

namespace App\Filament\Resources\Teches;

use App\Filament\Resources\Teches\Pages\CreateTech;
use App\Filament\Resources\Teches\Pages\EditTech;
use App\Filament\Resources\Teches\Pages\ListTeches;
use App\Filament\Resources\Teches\Schemas\TechForm;
use App\Filament\Resources\Teches\Tables\TechesTable;
use App\Models\Tech;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TechResource extends Resource
{
    protected static ?string $model = Tech::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TechForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TechesTable::configure($table);
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
            'index' => ListTeches::route('/'),
            'create' => CreateTech::route('/create'),
            'edit' => EditTech::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
