<?php

namespace App\Filament\Resources\Events\Challenges\Pages;

use App\Filament\Resources\Events\Challenges\ChallengeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateChallenge extends CreateRecord
{
    protected static string $resource = ChallengeResource::class;
}
