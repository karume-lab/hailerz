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
                ->description('New leads requiring response')
                ->descriptionIcon('heroicon-m-envelope-open')
                ->color('danger')
                ->url('/admin/inquiries?tableFilters[status][value]=new'),

            Stat::make('Talent Under Review', Talent::where('status', 'draft')->count())
                ->description('Applications to process')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('warning')
                ->url('/admin/talent?tableFilters[status][value]=draft'),

            Stat::make('Upcoming Events', Inquiry::where('status', InquiryStatus::Confirmed)
                ->where('event_date', '>=', now())
                ->where('event_date', '<=', now()->addDays(30))
                ->count())
                ->description('Confirmed events in next 30 days')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info')
                ->url('/admin/inquiries?tableFilters[status][value]=confirmed'),

            Stat::make('Unpublished Resources', \App\Models\ContentResource::where('is_published', false)->count())
                ->description('Drafts requiring review')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('gray')
                ->url('/admin/contents?tableFilters[is_published][value]=0'),

            Stat::make('Confirmed Bookings', Inquiry::where('status', InquiryStatus::Confirmed)->count())
                ->description('Total successful conversions')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success')
                ->url('/admin/inquiries?tableFilters[status][value]=confirmed'),

            Stat::make('Active Talent', Talent::where('status', 'active')->count())
                ->description('Live on the main site')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->url('/admin/talent?tableFilters[status][value]=active'),
        ];
    }
}
