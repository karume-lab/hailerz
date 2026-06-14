<?php

namespace App\Filament\Resources\Inquiries\Tables;

use App\Enums\InquiryStatus;
use App\Mail\TalentFrozenMail;
use App\Models\EmailTemplate;
use App\Models\Inquiry;
use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InquiryTable
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
            Tables\Columns\TextColumn::make('client_name')
                ->label('Planner / Organization')
                ->searchable(['first_name', 'last_name'])
                ->sortable(),
            Tables\Columns\TextColumn::make('client_email')
                ->label('Professional Email')
                ->searchable(['email']),
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
                ->money('NGN')
                ->sortable(),
            Tables\Columns\SelectColumn::make('status')
                ->label('Workflow Stage')
                ->options(collect(InquiryStatus::cases())->mapWithKeys(
                    fn (InquiryStatus $s) => [$s->value => $s->kanbanTitle()]
                ))
                ->sortable(),
        ];
    }

    protected static function getFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('status')
                ->label('Workflow Stage')
                ->options(collect(InquiryStatus::cases())->mapWithKeys(
                    fn (InquiryStatus $s) => [$s->value => $s->kanbanTitle()]
                )),
            Tables\Filters\TrashedFilter::make(),
        ];
    }

    protected static function getActions(): array
    {
        return [
            Actions\ActionGroup::make([
                Actions\Action::make('markNoShow')
                    ->label('Flag No Show')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->hidden(fn ($record) => $record->is_no_show || ! $record->talent_id)
                    ->action(function ($record) {
                        $record->update(['is_no_show' => true]);

                        $talent = $record->talent;
                        $noShowCount = Inquiry::where('talent_id', $talent->id)
                            ->where('is_no_show', true)
                            ->where('created_at', '>=', now()->subYear())
                            ->count();

                        if ($noShowCount >= 3) {
                            $talent->update(['is_frozen' => true]);
                            try {
                                Mail::to($talent->email)->send(new TalentFrozenMail($talent));
                            } catch (\Throwable $e) {
                                Log::error('Freeze mail failed: '.$e->getMessage());
                            }
                        }

                        Notification::make()
                            ->title('Marked as No Show')
                            ->body($noShowCount >= 3 ? "Talent profile has been frozen due to reaching {$noShowCount} no-shows." : "No-show recorded. Total count: {$noShowCount}/3.")
                            ->success()
                            ->send();
                    }),
                Actions\Action::make('sendEmail')
                    ->label('Send Email')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->modalHeading('Send Professional Response')
                    ->modalWidth('2xl')
                    ->form([
                        Select::make('template_id')
                            ->label('Select Template')
                            ->options(EmailTemplate::pluck('name', 'id'))
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $template = EmailTemplate::find($state);
                                if ($template) {
                                    $set('subject', $template->subject);
                                    $set('body', $template->body);
                                }
                            }),
                        TextInput::make('subject')
                            ->required(),
                        RichEditor::make('body')
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        Notification::make()
                            ->title('Communication Sent')
                            ->body("Professional response dispatched to {$record->client_name}.")
                            ->success()
                            ->send();
                    }),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
                Actions\RestoreAction::make(),
                Actions\ForceDeleteAction::make(),
            ]),
        ];
    }

    protected static function getBulkActions(): array
    {
        return [
            Actions\BulkActionGroup::make([
                Actions\DeleteBulkAction::make(),
                Actions\RestoreBulkAction::make(),
                Actions\ForceDeleteBulkAction::make(),
            ]),
        ];
    }
}
