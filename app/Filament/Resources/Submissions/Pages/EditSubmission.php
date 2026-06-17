<?php

namespace App\Filament\Resources\Submissions\Pages;

use App\Filament\Resources\Submissions\SubmissionResource;
use App\Helpers\CurrencyHelper;
use App\Mail\TalentAgreementMail;
use App\Models\Category;
use App\Models\Contract;
use App\Models\ContractSignature;
use App\Models\Submission;
use App\Models\Talent;
use App\Services\ContractPdfService;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class EditSubmission extends EditRecord
{
    protected static string $resource = SubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->label('Admit to Talent')
                ->icon('heroicon-o-check')
                ->color('success')
                ->requiresConfirmation()
                ->hidden(fn (Submission $record) => $record->status !== 'pending')
                ->action(function (Submission $record) {
                    DB::transaction(function () use ($record) {
                        $record->update(['status' => 'approved']);

                        $category = Category::firstOrCreate(['name' => $record->category]);

                        $talent = Talent::create([
                            'name' => $record->artist_name,
                            'talent_type' => $record->talent_type ?? 'individual',
                            'member_count' => $record->member_count,
                            'email' => $record->email,
                            'category_id' => $category->id,
                            'bio' => $record->bio,
                            'location' => $record->location,
                            'starting_price' => CurrencyHelper::convertToUsd((float) ($record->min_rate ?? 0), $record->currency ?? 'USD'),
                            'genre' => $record->genre,
                            'period_active' => $record->period_active,
                            'website_url' => $record->website_url,
                            'instagram_handle' => $record->instagram_handle,
                            'facebook_url' => $record->facebook_url,
                            'youtube_channel' => $record->youtube_channel,
                            'tiktok_handle' => $record->tiktok_handle,
                            'primary_image_url' => $record->profile_photo_url,
                            'status' => 'active',
                            'slug' => Str::slug($record->artist_name),
                        ]);

                        foreach ($record->gallery as $item) {
                            $talent->gallery()->create([
                                'url' => $item->url,
                                'title' => $item->title,
                                'description' => $item->description,
                            ]);
                        }

                        $contract = Contract::create([
                            'status' => 'pending',
                            'version' => '1.0',
                        ]);

                        $pdfService = app(ContractPdfService::class);
                        $html = view('pdf.talent-representation-agreement', [
                            'talent' => $talent,
                            'contract' => $contract,
                        ])->render();

                        $pdfService->generate(
                            $contract,
                            'Talent Representation Agreement',
                            'Hailerz Agency',
                            $talent->name,
                            $html
                        );

                        $signature = ContractSignature::create([
                            'contract_id' => $contract->id,
                            'signer_role' => 'Talent',
                            'signer_identifier' => $talent->email,
                        ]);

                        $signedUrl = URL::signedRoute('contracts.show', [
                            'contract' => $contract->id,
                            'role' => $signature->signer_role,
                            'email' => $signature->signer_identifier,
                        ]);

                        Mail::to($talent->email)->send(new TalentAgreementMail($talent, $signedUrl));
                    });

                    Notification::make()
                        ->title('Act Admitted to Agency Talent')
                        ->body('A new talent profile has been initialized based on this application.')
                        ->success()
                        ->send();

                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
