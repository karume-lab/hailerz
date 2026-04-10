<?php

namespace App\Filament\Resources\Contents;

use App\Filament\Resources\Contents\Pages;
use App\Models\ContentResource as ContentModel;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ContentResource extends Resource
{
    protected static ?string $model = ContentModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Manage Resources';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Select::make('type')
                ->options(['guide' => 'Industry Guide', 'news' => 'Agency News', 'asset' => 'Downloadable Asset']),
            Forms\Components\RichEditor::make('content')->columnSpanFull(),
            Forms\Components\FileUpload::make('file_path')->label('Attached File / PDF')->directory('resources'),
            Forms\Components\Toggle::make('is_published')->label('Published to Public Site'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
