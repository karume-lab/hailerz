<?php

namespace App\Filament\Resources\Talent\Tables;

use App\Models\Talent;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class TalentTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                SpatieMediaLibraryImageColumn::make('primary_image')
                    ->label('Artist Image')
                    ->collection('primary_image')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name='.urlencode($record->name).'&background=223757&color=ffffff'),
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
                    ->money('NGN')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Talent Status')
                    ->options([
                        'draft' => 'Under Review',
                        'awaiting_agreement' => 'Awaiting Agreement',
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
                        'draft' => 'Under Review',
                        'awaiting_agreement' => 'Awaiting Agreement',
                        'active' => 'Active',
                        'hidden' => 'Archived',
                    ]),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\Action::make('mark_signed')
                    ->label('Agreement Signed')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->hidden(fn (Talent $record) => $record->has_signed_agreement)
                    ->action(function (Talent $record) {
                        $record->update([
                            'has_signed_agreement' => true,
                            'agreement_signed_at' => now(),
                            'status' => 'active',
                        ]);

                        Notification::make()
                            ->title('Agreement Marked as Signed')
                            ->body("{$record->name} is now active on the public site.")
                            ->success()
                            ->send();
                    }),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
