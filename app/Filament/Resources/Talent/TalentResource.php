<?php

namespace App\Filament\Resources\Talent;

use App\Filament\Resources\Talent\Pages\CreateTalent;
use App\Filament\Resources\Talent\Pages\EditTalent;
use App\Filament\Resources\Talent\Pages\ListTalent;
use App\Filament\Resources\Talent\Schemas\TalentForm;
use App\Filament\Resources\Talent\Tables\TalentTable;
use App\Models\Talent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TalentResource extends Resource
{
    protected static ?string $model = Talent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static \UnitEnum|string|null $navigationGroup = 'Agency Talent';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return 'Agency Talent';
    }

    public static function getModelLabel(): string
    {
        return 'Talent';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Talent Talent';
    }

    public static function form(Schema $schema): Schema
    {
        return TalentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TalentTable::configure($table);
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
            'index' => ListTalent::route('/'),
            'create' => CreateTalent::route('/create'),
            'edit' => EditTalent::route('/{record}/edit'),
        ];
    }
}
