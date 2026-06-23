<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ChallengeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make()
                    ->heading('Challenge Operational Definition')
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
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2)->columnSpanFull(),

                Section::make()
                    ->heading('Gamified Timeline Metrics')
                    ->schema([
                        DateTimePicker::make('start_date')
                            ->required(),
                        DateTimePicker::make('end_date')
                            ->required()
                            ->after('start_date'),
                    ])->columns(2)->columnSpanFull(),

                Section::make()
                    ->heading('Detailed Guidelines')
                    ->schema([
                        Builder::make('description')
                            ->blocks([
                                Builder\Block::make('heading')
                                    ->schema([
                                        TextInput::make('content')
                                            ->label('Heading')
                                            ->required(),
                                        Select::make('level')
                                            ->options([
                                                'h2' => 'Heading 2',
                                                'h3' => 'Heading 3',
                                                'h4' => 'Heading 4',
                                            ])
                                            ->required(),
                                    ]),
                                Builder\Block::make('paragraph')
                                    ->schema([
                                        RichEditor::make('content')
                                            ->label('Paragraph')
                                            ->required()
                                            ->toolbarButtons([
                                                'bold', 'italic', 'strike', 'link', 'bulletList', 'orderedList',
                                            ]),
                                    ]),
                                Builder\Block::make('image')
                                    ->schema([
                                        FileUpload::make('url')
                                            ->label('Image')
                                            ->image()
                                            ->required(),
                                        TextInput::make('alt')
                                            ->label('Alt text')
                                            ->required(),
                                    ]),
                                Builder\Block::make('code')
                                    ->schema([
                                        Textarea::make('code')
                                            ->label('Code Snippet')
                                            ->rows(5)
                                            ->required(),
                                    ]),
                            ])
                            ->required()
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
            ]);
    }
}
