<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use App\Enums\InquiryStatus;
use App\Models\Talent;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Client Information')
                ->schema([
                    Forms\Components\TextInput::make('client_name')
                        ->required(),
                    Forms\Components\TextInput::make('client_email')
                        ->required()
                        ->email(),
                ])->columns(2),

            Section::make('Event Details')
                ->schema([
                    Forms\Components\Select::make('talent_id')
                        ->label('Requested Talent')
                        ->relationship('talent', 'name')
                        ->searchable()
                        ->preload()
                        ->placeholder('General Inquiry'),
                    Forms\Components\Select::make('event_type')
                        ->options([
                            'Corporate'  => 'Corporate Event',
                            'Wedding'    => 'Wedding',
                            'Private'    => 'Private Party',
                            'Nightclub'  => 'Nightclub / Ticketed',
                            'Conference' => 'Conference',
                            'Other'      => 'Other',
                        ])
                        ->required(),
                    Forms\Components\DatePicker::make('event_date')
                        ->required(),
                    Forms\Components\TextInput::make('budget')
                        ->numeric()
                        ->prefix('$'),
                ])->columns(2),

            Section::make('Message')
                ->schema([
                    Forms\Components\Textarea::make('message')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),
                ]),

            Section::make('Pipeline Status')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options(collect(InquiryStatus::cases())->mapWithKeys(
                            fn (InquiryStatus $s) => [$s->value => $s->kanbanTitle()]
                        ))
                        ->required(),
                ])->columns(1),
        ]);
    }
}
