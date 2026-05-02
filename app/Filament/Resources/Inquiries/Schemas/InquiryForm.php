<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use App\Enums\InquiryStatus;
use App\Models\Talent;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Client Information')
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('last_name')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('phone')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('company')
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Event Specifications')
                ->schema([
                    Forms\Components\Select::make('talent_id')
                        ->label('Requested Talent / Act')
                        ->relationship('talent', 'name')
                        ->searchable()
                        ->preload()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('event_type')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\DatePicker::make('event_date')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('event_time')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('performance_duration')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('venue_name')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('city')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('state')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('expected_guests')
                        ->numeric()
                        ->required()
                        ->columnSpan(1),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Talent Preferences')
                ->schema([
                    Forms\Components\TextInput::make('talent_category')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('preferred_genre')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('budget_range')
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('specific_talent')
                        ->columnSpan(1),
                    Forms\Components\Textarea::make('additional_details')
                        ->rows(6)
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Procurement & Status')
                ->schema([
                    Forms\Components\TextInput::make('source')
                        ->label('Source')
                        ->disabled()
                        ->columnSpan(1),
                    Forms\Components\Select::make('status')
                        ->label('Inquiry Stage')
                        ->options(collect(InquiryStatus::cases())->mapWithKeys(
                            fn (InquiryStatus $s) => [$s->value => $s->kanbanTitle()]
                        ))
                        ->required()
                        ->columnSpan(1),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}
