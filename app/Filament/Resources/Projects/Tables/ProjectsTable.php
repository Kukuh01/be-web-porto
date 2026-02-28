<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                ->searchable()
                ->sortable(),

                ImageColumn::make('thumbnail')
                ->disk('public'),

                TextColumn::make('description')
                ->limit(100)
                ->searchable(),

                TextColumn::make('url_github')
                ->searchable(),

                TextColumn::make('url_site')
                ->searchable(),

                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'deployed' => 'info',
                    'undeployed' => 'success',
                    'on progres' => 'danger'
                }),

                TextColumn::make('created_at')
                ->label('Created')
                ->dateTime('d F Y, H:i:s')
                ->timezone('Asia/Jakarta')
                ->sortable()
                ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
