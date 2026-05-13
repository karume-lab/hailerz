<?php

namespace App\Filament\Resources\StaffingInquiries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class StaffingInquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('company'),
                Textarea::make('needs')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'new' => 'New',
                        'replied' => 'Replied',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'archived' => 'Archived',
                    ])
                    ->required()
                    ->default('new'),
                Textarea::make('admin_notes')
                    ->columnSpanFull(),
            ]);
    }
}
