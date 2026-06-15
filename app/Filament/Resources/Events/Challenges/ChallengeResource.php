<?php

namespace App\Filament\Resources\Events\Challenges;

use App\Filament\Resources\Events\Challenges\Pages\CreateChallenge;
use App\Filament\Resources\Events\Challenges\Pages\EditChallenge;
use App\Filament\Resources\Events\Challenges\Pages\ListChallenges;
use App\Filament\Resources\Events\Challenges\Tables\ChallengesTable;
use App\Filament\Resources\Events\Schemas\ChallengeForm;
use App\Models\Challenge;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ChallengeResource extends Resource
{
    protected static ?string $model = Challenge::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ChallengeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChallengesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChallenges::route('/'),
            'create' => CreateChallenge::route('/create'),
            'edit' => EditChallenge::route('/{record}/edit'),
        ];
    }
}
