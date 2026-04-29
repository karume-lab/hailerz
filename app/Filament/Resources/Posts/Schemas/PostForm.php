<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Post;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Article Details')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->columnSpanFull()
                        ->afterStateUpdated(fn ($state, $set)
                            => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->hidden()
                        ->dehydrated()
                        ->required()
                        ->columnSpanFull()
                        ->unique(Post::class, 'slug', ignoreRecord: true),
                    Forms\Components\Toggle::make('is_published')
                        ->label('Published')
                        ->columnSpanFull(),
                ])
                ->columns(1)
                ->columnSpanFull(),

            Section::make('Content')
                ->schema([
                    Forms\Components\RichEditor::make('content')
                        ->required()
                        ->columnSpanFull()
                        ->extraAttributes(['style' => 'min-height: 500px']),
                ])
                ->columnSpanFull(),
        ]);
    }
}
