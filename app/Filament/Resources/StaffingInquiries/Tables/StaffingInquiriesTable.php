<?php

namespace App\Filament\Resources\StaffingInquiries\Tables;

use App\Mail\StaffingInquiryReply;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class StaffingInquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'gray',
                        'replied' => 'info',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        'archived' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('reply')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('primary')
                    ->form([
                        Textarea::make('message')
                            ->label('Reply Message')
                            ->required()
                            ->rows(5),
                    ])
                    ->action(function (array $data, $record) {
                        Mail::to($record->email)->send(new StaffingInquiryReply($data['message']));

                        $record->update([
                            'status' => 'replied',
                            'admin_notes' => ($record->admin_notes ? $record->admin_notes."\n\n" : '').'Replied on '.now()->toDateTimeString().":\n".$data['message'],
                        ]);

                        Notification::make()
                            ->title('Reply sent successfully')
                            ->success()
                            ->send();
                    }),
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
