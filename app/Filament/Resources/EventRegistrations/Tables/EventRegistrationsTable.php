<?php

namespace App\Filament\Resources\EventRegistrations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EventRegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event.title')
                    ->label('Event')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('guest_name')
                    ->label('Attendee Name')
                    ->searchable(),
                TextColumn::make('guest_email')
                    ->label('Attendee Email')
                    ->searchable(),
                TextColumn::make('pass_type')
                    ->badge()
                    ->colors([
                        'primary' => 'attendee',
                        'success' => 'exhibitor',
                    ]),
                TextColumn::make('total_amount')
                    ->money('NGN')
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'failed',
                    ]),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('event_id')
                    ->relationship('event', 'title')
                    ->label('Filter by Event'),
                SelectFilter::make('pass_type')
                    ->options([
                        'attendee' => 'Attendee Pass',
                        'exhibitor' => 'Exhibitor / Host',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
