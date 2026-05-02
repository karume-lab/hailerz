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
                        ->afterStateUpdated(fn (string $operation, $state, $set)
                            => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('slug')
                        ->hidden()
                        ->dehydrated()
                        ->required()
                        ->unique(Talent::class, 'slug', ignoreRecord: true)
                        ->columnSpan(1),
                    Forms\Components\Select::make('category_id')
                        ->label('Discipline / Category')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Executive Biography & Career Highlights')
                ->schema([
                    Forms\Components\RichEditor::make('bio')
                        ->label('Artist Biography')
                        ->placeholder("Detail the performer's experience with corporate clients, notable venues, and performance scale...")
                        ->required()
                        ->columnSpanFull()
                        ->extraAttributes(['style' => 'min-height: 350px']),
                ])
                ->columnSpanFull(),

            Section::make('Media & Performance Assets')
                ->description('All media should be provided as links — no file uploads required.')
                ->schema([
                    Forms\Components\TextInput::make('primary_image_url')
                        ->label('Primary Promotional Image URL')
                        ->url()
                        ->placeholder('https://...')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('video_url')
                        ->url()
                        ->label('Showreel / Performance Link')
                        ->placeholder('https://youtube.com/watch?v=...')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('rate_card_url')
                        ->url()
                        ->label('Rate Card URL')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('technical_rider')
                        ->label('Technical Rider URL')
                        ->columnSpanFull(),
                    
                    Forms\Components\TextInput::make('website_url')
                        ->label('Website URL')
                        ->url()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('instagram_handle')
                        ->label('Instagram URL')
                        ->url()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('facebook_url')
                        ->label('Facebook URL')
                        ->url()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('youtube_channel')
                        ->label('YouTube Channel URL')
                        ->url()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('tiktok_handle')
                        ->label('TikTok URL')
                        ->url()
                        ->columnSpan(1),

                    Forms\Components\Repeater::make('gallery')
                        ->relationship('gallery')
                        ->label('Portfolio Gallery Links')
                        ->schema([
                            Forms\Components\TextInput::make('url')
                                ->label('Media URL (image, YouTube, Vimeo)')
                                ->url()
                                ->required()
                                ->columnSpan(2),
                            Forms\Components\TextInput::make('title')
                                ->label('Title')
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('description')
                                ->label('Description')
                                ->columnSpan(1),
                        ])
                        ->columns(4)
                        ->defaultItems(0)
                        ->reorderable(true)
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Financial Parameters & Logistics')
                ->schema([
                    Forms\Components\TextInput::make('location')
                        ->label('Primary Base (City, Country)')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('starting_price')
                        ->label('Minimum Performance Fee (USD)')
                        ->numeric()
                        ->prefix('$')
                        ->columnSpan(1),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Agency Procurement Status')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Talent Status')
                        ->options([
                            'draft'  => 'Under Review',
                            'active' => 'Active on Talent',
                            'hidden' => 'Archived / Private',
                        ])
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\Toggle::make('is_featured')
                        ->label('Premium Placement')
                        ->inline(false)
                        ->columnSpan(1),
                    Forms\Components\Textarea::make('internal_notes')
                        ->label('Internal Agency Notes')
                        ->helperText('Notes for internal booking agents only — never shown to clients.')
                        ->rows(3)
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}
