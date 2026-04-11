<?php

namespace App\Filament\Resources\Inquiries;

use App\Filament\Resources\Inquiries\Pages\CreateInquiry;
use App\Filament\Resources\Inquiries\Pages\EditInquiry;
use App\Filament\Resources\Inquiries\Pages\ListInquiries;
use App\Filament\Resources\Inquiries\Schemas\InquiryForm;
use App\Filament\Resources\Inquiries\Tables\InquiriesTable;
use App\Models\Inquiry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleBottomCenterText;
    
    protected static \UnitEnum|string|null $navigationGroup = 'Bookings';

    public static function form(Schema $schema): Schema
    {
        return \App\Filament\Resources\Inquiries\Schemas\InquiryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return \App\Filament\Resources\Inquiries\Tables\InquiryTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Inquiries\Pages\BookingPipeline::route('/'),
            'create' => \App\Filament\Resources\Inquiries\Pages\CreateInquiry::route('/create'),
            'edit' => \App\Filament\Resources\Inquiries\Pages\EditInquiry::route('/{record}/edit'),
        ];
    }
}
