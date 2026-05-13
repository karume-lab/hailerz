<?php

namespace App\Filament\Resources\StaffingInquiries;

use App\Filament\Resources\StaffingInquiries\Pages\CreateStaffingInquiry;
use App\Filament\Resources\StaffingInquiries\Pages\EditStaffingInquiry;
use App\Filament\Resources\StaffingInquiries\Pages\ListStaffingInquiries;
use App\Filament\Resources\StaffingInquiries\Pages\ViewStaffingInquiry;
use App\Filament\Resources\StaffingInquiries\Schemas\StaffingInquiryForm;
use App\Filament\Resources\StaffingInquiries\Schemas\StaffingInquiryInfolist;
use App\Filament\Resources\StaffingInquiries\Tables\StaffingInquiriesTable;
use App\Models\StaffingInquiry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffingInquiryResource extends Resource
{
    protected static ?string $model = StaffingInquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'email';

    public static function form(Schema $schema): Schema
    {
        return StaffingInquiryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StaffingInquiryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StaffingInquiriesTable::configure($table);
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
            'index' => ListStaffingInquiries::route('/'),
            'create' => CreateStaffingInquiry::route('/create'),
            'view' => ViewStaffingInquiry::route('/{record}'),
            'edit' => EditStaffingInquiry::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
