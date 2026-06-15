<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ChallengeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Challenge Operational Definition')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('prize_pool')
                            ->numeric()
                            ->required()
                            ->prefix('NGN')
                            ->default(0.00),
                        FileUpload::make('banner_image')
                            ->image()
                            ->directory('challenges-banners')
                            ->required(),
                    ])->columns(3),

                Section::make('Gamified Timeline Metrics')
                    ->schema([
                        DateTimePicker::make('start_date')
                            ->required(),
                        DateTimePicker::make('end_date')
                            ->required()
                            ->after('start_date'),
                    ])->columns(2),

                Section::make('Detailed Guidelines')
                    ->schema([
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'blockquote', 'bold', 'bulletList', 'codeBlock',
                                'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'undo',
                            ]),
                    ]),
            ]);
    }
}
