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
            Section::make('Professional Identity')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Performer / Act Name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, callable $set)
                            => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    Forms\Components\TextInput::make('slug')
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->unique(Talent::class, 'slug', ignoreRecord: true),
                    Forms\Components\Select::make('category_id')
                        ->label('Discipline / Category')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                ])->columns(3),

            Section::make('Executive Biography & Career Highlights')
                ->schema([
                    Forms\Components\RichEditor::make('bio')
                        ->label('Artist Biography')
                        ->placeholder('Detail the performer\'s experience with corporate clients, notable venues, and performance scale...')
                        ->required()
                        ->columnSpanFull(),
                ]),

            Section::make('Performance Assets & Technical Requirements')
                ->schema([
                    \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('primary_image')
                        ->label('Primary Promotional Image')
                        ->collection('primary_image')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),
                    \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                        ->label('Portfolio Gallery')
                        ->collection('gallery')
                        ->multiple()
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),
                    \Filament\Forms\Components\TextInput::make('video_url')
                        ->url()
                        ->label('Showreel / Performance Link')
                        ->placeholder('https://youtube.com/watch?v=...')
                        ->columnSpanFull(),
                    \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('rate_card')
                        ->collection('rate_card')
                        ->acceptedFileTypes(['application/pdf'])
                        ->label('Rate Card / Investment Parameters (PDF)'),
                    \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('technical_rider')
                        ->collection('technical_rider')
                        ->acceptedFileTypes(['application/pdf'])
                        ->label('Technical Rider / Stage Requirements (PDF)'),
                ]),

            Section::make('Financial Parameters & Logistics')
                ->schema([
                    Forms\Components\TextInput::make('location')
                        ->label('Primary Base (City, Country)')
                        ->required(),
                    Forms\Components\TextInput::make('starting_price')
                        ->label('Minimum Performance Fee (USD)')
                        ->numeric()
                        ->prefix('$'),
                ])->columns(2),

            Section::make('Agency Procurement Status')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Roster Status')
                        ->options([
                            'draft'  => 'Under Review',
                            'active' => 'Active on Roster',
                            'hidden' => 'Archived / Private',
                        ])
                        ->required(),
                    Forms\Components\Toggle::make('is_featured')
                        ->label('Premium Placement'),
                    Forms\Components\Textarea::make('internal_notes')
                        ->label('Internal Agency Notes')
                        ->helperText('Notes for internal booking agents only - never shown to clients.')
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }
}
