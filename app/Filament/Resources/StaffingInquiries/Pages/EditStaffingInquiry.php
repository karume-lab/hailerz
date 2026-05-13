<?php

namespace App\Filament\Resources\StaffingInquiries\Pages;

use App\Filament\Resources\StaffingInquiries\StaffingInquiryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStaffingInquiry extends EditRecord
{
    protected static string $resource = StaffingInquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
