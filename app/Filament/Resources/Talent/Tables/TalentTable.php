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
                    ->label('Artist Image')
                    ->collection('primary_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Act / Performer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Discipline')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Base Location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('starting_price')
                    ->label('Minimum Fee')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Roster Status')
                    ->options([
                        'draft'  => 'Under Review',
                        'active' => 'Active',
                        'hidden' => 'Archived',
                    ])
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Premium Placement'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Discipline')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft'  => 'Under Review',
                        'active' => 'Active',
                        'hidden' => 'Archived',
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
