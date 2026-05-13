<?php

namespace App\Filament\Resources\StaffingInquiries\Schemas;

use App\Models\StaffingInquiry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StaffingInquiryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('first_name'),
                TextEntry::make('last_name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('phone')
                    ->placeholder('-'),
                TextEntry::make('company')
                    ->placeholder('-'),
                TextEntry::make('needs')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'gray',
                        'replied' => 'info',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        'archived' => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('admin_notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (StaffingInquiry $record): bool => $record->trashed()),
            ]);
    }
}
