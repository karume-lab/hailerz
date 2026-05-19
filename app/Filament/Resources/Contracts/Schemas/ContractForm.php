<?php

namespace App\Filament\Resources\Contracts\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContractForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contract Details')
                ->schema([
                    Forms\Components\TextInput::make('booking_id')
                        ->label('Booking ID')
                        ->numeric()
                        ->nullable()
                        ->columnSpan(1),
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'pending' => 'Pending',
                            'in_review' => 'In Review',
                            'signed' => 'Signed',
                            'voided' => 'Voided',
                        ])
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('version')
                        ->label('Version')
                        ->default('1.0')
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\TextInput::make('file_hash')
                        ->label('SHA-256 File Hash')
                        ->disabled()
                        ->dehydrated(false)
                        ->placeholder('Generated automatically on saving')
                        ->columnSpan(1),
                    Forms\Components\FileUpload::make('file_path')
                        ->label('Contract Document (PDF)')
                        ->disk('local')
                        ->directory('contracts')
                        ->acceptedFileTypes(['application/pdf'])
                        ->required()
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

            Section::make('Signatures / Signees')
                ->description('Specify the signees for this contract. The routing will go in order of the list below.')
                ->schema([
                    Forms\Components\Repeater::make('signatures')
                        ->relationship('signatures')
                        ->label('Signers List')
                        ->schema([
                            Forms\Components\TextInput::make('signer_role')
                                ->label('Role (e.g. Performer, Client, Agency)')
                                ->required()
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('signer_identifier')
                                ->label('Signer Email / Phone')
                                ->required()
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('token_id')
                                ->label('Signature Token')
                                ->disabled()
                                ->dehydrated(false)
                                ->placeholder('Auto-generated on sign')
                                ->columnSpan(1),
                            Forms\Components\DateTimePicker::make('signed_at')
                                ->label('Signed At')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('ip_address')
                                ->label('IP Address')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(1),
                            Forms\Components\Textarea::make('user_agent')
                                ->label('User Agent')
                                ->disabled()
                                ->dehydrated(false)
                                ->rows(1)
                                ->columnSpan(1),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->reorderable(true)
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ]);
    }
}
