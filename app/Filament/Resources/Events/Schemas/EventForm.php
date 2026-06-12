<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        DateTimePicker::make('date')
                            ->required(),
                        TextInput::make('location')
                            ->required(),
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(3),

                Section::make('Financial Configurations')
                    ->schema([
                        TextInput::make('exhibitor_price')
                            ->required()
                            ->numeric()
                            ->default(350000)
                            ->prefix('NGN'),
                        TextInput::make('attendee_price')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->prefix('NGN'),
                    ])->columns(2),

                Section::make('Value Curation & Demographic Metadata')
                    ->schema([
                        KeyValue::make('demographics')
                            ->keyLabel('Skill Group (e.g., Designers)')
                            ->valueLabel('Percentage (e.g., 46)')
                            ->columnSpanFull(),
                        Repeater::make('universities')
                            ->schema([
                                TextInput::make('name')->required(),
                                FileUpload::make('logo')->image()->directory('event-universities')->required(),
                            ])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
