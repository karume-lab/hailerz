<?php

namespace App\Filament\Resources\Talent\Schemas;

use App\Models\Talent;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class TalentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Basic Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set)
                            => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    Forms\Components\TextInput::make('slug')
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->unique(Talent::class, 'slug', ignoreRecord: true),
                    Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                ])->columns(3),

            Section::make('Profile Content')
                ->schema([
                    Forms\Components\RichEditor::make('bio')
                        ->required()
                        ->columnSpanFull(),
                ]),

            Section::make('Media & Documents')
                ->schema([
                    \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('primary_image')
                        ->collection('primary_image')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),
                    \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                        ->collection('gallery')
                        ->multiple()
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),
                    \Filament\Forms\Components\TextInput::make('video_url')
                        ->url()
                        ->label('Performance Video URL')
                        ->columnSpanFull(),
                    \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('rate_card')
                        ->collection('rate_card')
                        ->acceptedFileTypes(['application/pdf'])
                        ->label('Rate Card (PDF)'),
                    \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('technical_rider')
                        ->collection('technical_rider')
                        ->acceptedFileTypes(['application/pdf'])
                        ->label('Technical Rider (PDF)'),
                ]),

            Section::make('Logistics & Pricing')
                ->schema([
                    Forms\Components\TextInput::make('location')
                        ->required(),
                    Forms\Components\TextInput::make('starting_price')
                        ->numeric()
                        ->prefix('$'),
                ])->columns(2),

            Section::make('Agency Internal (Hidden from Public)')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'draft'  => 'Draft',
                            'active' => 'Active',
                            'hidden' => 'Hidden',
                        ])
                        ->required(),
                    Forms\Components\Toggle::make('is_featured'),
                    Forms\Components\Textarea::make('internal_notes')
                        ->helperText('Notes for agency staff only - never shown publicly.')
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }
}
