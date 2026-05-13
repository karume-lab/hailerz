<?php

namespace App\Filament\Resources\StaffingInquiries\Pages;

use App\Filament\Resources\StaffingInquiries\StaffingInquiryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStaffingInquiries extends ListRecords
{
    protected static string $resource = StaffingInquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
