<?php

namespace App\Filament\Resources\EventRegistrations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EventRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Registration Details')->schema([
                    Select::make('event_id')
                        ->relationship('event', 'title')
                        ->required(),
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->label('Registered By User')
                        ->nullable(),
                    TextInput::make('guest_name')
                        ->label('Attendee Name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('guest_email')
                        ->label('Attendee Email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Select::make('pass_type')
                        ->options([
                            'attendee' => 'Attendee Pass',
                            'exhibitor' => 'Exhibitor / Host',
                        ])
                        ->required(),
                ])->columns(2),

                Section::make('Payment Information')->schema([
                    TextInput::make('total_amount')
                        ->numeric()
                        ->prefix('NGN')
                        ->required(),
                    Select::make('payment_status')
                        ->options([
                            'pending' => 'Pending',
                            'confirmed' => 'Confirmed',
                            'failed' => 'Failed',
                        ])
                        ->required(),
                    TextInput::make('payment_reference')
                        ->maxLength(255),
                ])->columns(3),

                Section::make('Exhibitor Details')->schema([
                    TextInput::make('company_name')
                        ->maxLength(255),
                    Textarea::make('company_description')
                        ->maxLength(1000)
                        ->columnSpanFull(),
                    TextInput::make('company_logo')
                        ->label('Company Logo Base64')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])->columns(1),
            ]);
    }
}
