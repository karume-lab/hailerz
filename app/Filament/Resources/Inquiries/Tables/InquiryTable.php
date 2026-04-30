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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Actions\ActionGroup::make([
                    Actions\Action::make('sendEmail')
                        ->label('Send Email')
                        ->icon('heroicon-o-envelope')
                        ->color('info')
                        ->modalHeading('Send Professional Response')
                        ->modalWidth('2xl')
                        ->form([
                            \Filament\Forms\Components\Select::make('template_id')
                                ->label('Select Template')
                                ->options(\App\Models\EmailTemplate::pluck('name', 'id'))
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $template = \App\Models\EmailTemplate::find($state);
                                    if ($template) {
                                        $set('subject', $template->subject);
                                        $set('body', $template->body);
                                    }
                                }),
                            \Filament\Forms\Components\TextInput::make('subject')
                                ->required(),
                            \Filament\Forms\Components\RichEditor::make('body')
                                ->required(),
                        ])
                        ->action(function ($record, array $data) {
                            \Filament\Notifications\Notification::make()
                                ->title('Communication Sent')
                                ->body("Professional response dispatched to {$record->client_name}.")
                                ->success()
                                ->send();
                        }),
                    Actions\EditAction::make(),
                    Actions\DeleteAction::make(),
                    Actions\RestoreAction::make(),
                    Actions\ForceDeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                    Actions\RestoreBulkAction::make(),
                    Actions\ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
