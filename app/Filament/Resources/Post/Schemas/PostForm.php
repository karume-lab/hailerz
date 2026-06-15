<?php

namespace App\Filament\Resources\Post\Schemas;

use App\Models\Post;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Post Details')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(Post::class, 'slug', ignoreRecord: true),
                    Forms\Components\Select::make('category')
                        ->options([
                            'Guides' => 'Guides',
                            'Industry' => 'Industry',
                            'News' => 'News',
                            'Tips' => 'Tips',
                            'Events' => 'Events',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('author')
                        ->default('Hailerz Team')
                        ->required(),
                    Forms\Components\TextInput::make('image_url')
                        ->label('Feature Image URL')
                        ->url()
                        ->required(),
                    Forms\Components\Textarea::make('subtitle')
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2)
                ->columnSpanFull(),

            Section::make('Content Blocks')
                ->schema([
                    Forms\Components\Repeater::make('content')
                        ->schema([
                            Forms\Components\Select::make('type')
                                ->options([
                                    'p' => 'Paragraph',
                                    'h2' => 'Heading 2',
                                ])
                                ->required()
                                ->columnSpan(1),
                            Forms\Components\Textarea::make('text')
                                ->required()
                                ->rows(3)
                                ->columnSpan(3),
                        ])
                        ->columns(4)
                        ->reorderable(true)
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Section::make('Publishing')
                ->schema([
                    Forms\Components\Toggle::make('is_published')
                        ->default(true),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->default(now()),
                ])->columns(2)
                ->columnSpanFull(),
        ]);
    }
}
