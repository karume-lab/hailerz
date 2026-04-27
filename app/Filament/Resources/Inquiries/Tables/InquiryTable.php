<?php

namespace App\Filament\Resources\Inquiries\Tables;

use App\Enums\InquiryStatus;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

class InquiryTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client_name')
                    ->label('Planner / Organization')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_email')
                    ->label('Professional Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('talent.name')
                    ->label('Requested Act')
                    ->default('General Agency Inquiry')
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_type')
                    ->label('Engagement Nature')
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label('Engagement Date')
                    ->date('M d, Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget')
                    ->label('Allocated Budget')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Workflow Stage')
                    ->options(collect(InquiryStatus::cases())->mapWithKeys(
                        fn (InquiryStatus $s) => [$s->value => $s->kanbanTitle()]
                    ))
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Workflow Stage')
                    ->options(collect(InquiryStatus::cases())->mapWithKeys(
                        fn (InquiryStatus $s) => [$s->value => $s->kanbanTitle()]
                    )),
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
