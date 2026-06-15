<?php

namespace App\Filament\Resources\Events\Challenges\Pages;

use App\Filament\Resources\Events\Challenges\ChallengeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditChallenge extends EditRecord
{
    protected static string $resource = ChallengeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
