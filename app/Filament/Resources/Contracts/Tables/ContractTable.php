<?php

namespace App\Filament\Resources\Contracts\Tables;

use App\Models\Contract;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\URL;

class ContractTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(static::getColumns())
            ->defaultSort('created_at', 'desc')
            ->filters(static::getFilters())
            ->actions(static::getActions())
            ->bulkActions(static::getBulkActions());
    }

    protected static function getColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')
                ->label('Contract UUID')
                ->searchable()
                ->sortable()
                ->toggleable()
                ->formatStateUsing(fn (string $state): string => substr($state, 0, 8).'...'),
            Tables\Columns\TextColumn::make('booking_id')
                ->label('Booking ID')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('version')
                ->label('Version')
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'in_review' => 'info',
                    'signed' => 'success',
                    'voided' => 'danger',
                    default => 'gray',
                })
                ->sortable(),
            Tables\Columns\TextColumn::make('signatures_count')
                ->label('Signers')
                ->state(function (Contract $record): string {
                    $total = $record->signatures()->count();
                    $signed = $record->signatures()->whereNotNull('signed_at')->count();

                    return "{$signed} / {$total}";
                }),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime('M d, Y H:i')
                ->sortable(),
        ];
    }

    protected static function getFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'pending' => 'Pending',
                    'in_review' => 'In Review',
                    'signed' => 'Signed',
                    'voided' => 'Voided',
                ]),
        ];
    }

    protected static function getActions(): array
    {
        return [
            Actions\ActionGroup::make([
                Actions\Action::make('download')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->url(fn ($record) => URL::signedRoute('contracts.download', ['contract' => $record->id]))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => ! empty($record->file_path)),
                Actions\Action::make('view_public')
                    ->label('View Public Link')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(function ($record) {
                        $signer = $record->signatures()->whereNull('signed_at')->first()
                            ?? $record->signatures()->first();
                        if ($signer) {
                            return URL::signedRoute('contracts.show', [
                                'contract' => $record->id,
                                'role' => $signer->signer_role,
                                'email' => $signer->signer_identifier,
                            ]);
                        }

                        return null;
                    })
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->signatures()->exists()),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ]),
        ];
    }

    protected static function getBulkActions(): array
    {
        return [
            Actions\BulkActionGroup::make([
                Actions\DeleteBulkAction::make(),
            ]),
        ];
    }
}
