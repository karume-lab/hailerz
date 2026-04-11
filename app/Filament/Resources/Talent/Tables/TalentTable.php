<?php

namespace App\Filament\Resources\Talent\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

class TalentTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\SpatieMediaLibraryImageColumn::make('primary_image')
                    ->label('Photo')
                    ->collection('primary_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('starting_price')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'draft'  => 'Draft',
                        'active' => 'Active',
                        'hidden' => 'Hidden',
                    ])
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Featured'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft'  => 'Draft',
                        'active' => 'Active',
                        'hidden' => 'Hidden',
                    ]),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
