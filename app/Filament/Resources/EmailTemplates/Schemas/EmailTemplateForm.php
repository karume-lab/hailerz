<?php

namespace App\Filament\Resources\EmailTemplates\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EmailTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Template Identity')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->helperText('Internal identifier e.g. "Application Received", "Booking Confirmation"')
                            ->columnSpan(1),
                        TextInput::make('subject')
                            ->required()
                            ->helperText('The email subject line sent to recipients. Supports {{variable}} placeholders.')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Email Body')
                    ->schema([
                        RichEditor::make('body')
                            ->required()
                            ->columnSpanFull()
                            ->extraAttributes(['style' => 'min-height: 500px'])
                            ->helperText('Use full HTML to include your logo, letterhead, and footer sign-off. Supports {{variable}} placeholders for dynamic content.')
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
