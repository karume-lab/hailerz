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
            Section::make('Event Planner / Organization')
                ->schema([
                    Forms\Components\TextInput::make('client_name')
                        ->label('Contact Person / Organization')
                        ->required(),
                    Forms\Components\TextInput::make('client_email')
                        ->label('Professional Email')
                        ->required()
                        ->email(),
                ])->columns(2),

            Section::make('Engagement Specifications')
                ->schema([
                    Forms\Components\Select::make('talent_id')
                        ->label('Requested Talent / Act')
                        ->relationship('talent', 'name')
                        ->searchable()
                        ->preload()
                        ->placeholder('General Agency Inquiry'),
                    Forms\Components\Select::make('event_type')
                        ->label('Nature of Event')
                        ->options([
                            'Corporate'  => 'Corporate Gala / Summit',
                            'Wedding'    => 'Luxury Wedding',
                            'Private'    => 'Private Exclusive Party',
                            'Nightclub'  => 'Premier Venue / Ticketed',
                            'Conference' => 'Professional Conference',
                            'Other'      => 'Special Engagement',
                        ])
                        ->required(),
                    Forms\Components\DatePicker::make('event_date')
                        ->label('Proposed Engagement Date')
                        ->required(),
                    Forms\Components\TextInput::make('budget')
                        ->label('Allocated Talent Budget (USD)')
                        ->numeric()
                        ->prefix('$'),
                ])->columns(2),

            Section::make('Requirements & Briefing')
                ->schema([
                    Forms\Components\Textarea::make('message')
                        ->label('Event Concept & Performer Brief')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),
                ]),

            Section::make('Procurement Workflow Stage')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Inquiry Stage')
                        ->options(collect(InquiryStatus::cases())->mapWithKeys(
                            fn (InquiryStatus $s) => [$s->value => $s->kanbanTitle()]
                        ))
                        ->required(),
                ])->columns(1),
        ]);
    }
}
