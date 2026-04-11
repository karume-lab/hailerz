<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use App\Models\Talent;
use App\Enums\InquiryStatus;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Inquiries', Inquiry::where('status', InquiryStatus::New)->count())
                ->description('Requires immediate attention')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger'),
            Stat::make('Active Talent', Talent::where('status', 'active')->count()),
            Stat::make('Confirmed Bookings', Inquiry::where('status', InquiryStatus::Confirmed)->count())
                ->color('success'),
        ];
    }
}
