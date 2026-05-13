<?php

namespace App\Filament\Resources\StaffingInquiries\Pages;

use App\Filament\Resources\StaffingInquiries\StaffingInquiryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStaffingInquiry extends ViewRecord
{
    protected static string $resource = StaffingInquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
