<?php

namespace App\Filament\Resources\Talent;

use App\Filament\Resources\Talent\Pages\CreateTalent;
use App\Filament\Resources\Talent\Pages\EditTalent;
use App\Filament\Resources\Talent\Pages\ListTalent;
use App\Filament\Resources\Talent\Schemas\TalentForm;
use App\Filament\Resources\Talent\Tables\TalentTable;
use App\Models\Talent;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class TalentResource extends Resource
{
    protected static ?string $model = Talent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category')
                    ->options([
                        'musician' => 'Musician',
                        'dj' => 'DJ',
                        'speaker' => 'Speaker',
                        'comedian' => 'Comedian',
                        'mc' => 'MC',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('min_fee')
                    ->numeric()
                    ->prefix('$')
                    ->label('Minimum Booking Fee'),

                // Degy-Inspired Routing
                Forms\Components\TagsInput::make('target_markets')
                    ->suggestions(['College Circuit', 'Corporate Approved', 'Military Base Ready'])
                    ->label('Target Markets'),
                Forms\Components\Toggle::make('is_virtual_ready')
                    ->label('Equipped for Virtual Live Streams'),

                // Media Uploads
                Forms\Components\FileUpload::make('headshot_path')
                    ->image()
                    ->directory('talent-headshots')
                    ->label('Promotional Headshot'),
                Forms\Components\FileUpload::make('rider_path')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('talent-riders')
                    ->label('Technical Rider (PDF)'),

                Forms\Components\RichEditor::make('bio')
                    ->columnSpanFull()
                    ->label('Artist Biography'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('headshot_path')
                    ->circular()
                    ->label('Photo'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('min_fee')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_virtual_ready')
                    ->boolean()
                    ->label('Virtual'),
            ])
            ->filters([
                // Add table filters here later if needed
            ]);
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
