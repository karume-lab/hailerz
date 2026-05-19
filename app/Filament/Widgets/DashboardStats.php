<?php

namespace App\Filament\Widgets;

use App\Enums\InquiryStatus;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\StaffingInquiry;
use App\Models\Submission;
use App\Models\Talent;
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

            Stat::make('Pending Applications', Submission::where('status', 'pending')->count())
                ->description('New talent applications')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('warning')
                ->url('/admin/submissions?tableFilters[status][value]=pending'),

            Stat::make('Staffing Requests', StaffingInquiry::count())
                ->description('Augmentation & staffing inquiries')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('primary')
                ->url('/admin/staffing-inquiries'),

            Stat::make('Total Applications', Submission::count())
                ->description('Total roster submissions')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('info')
                ->url('/admin/submissions'),

            Stat::make('Talent Under Review', Talent::where('status', 'draft')->count())
                ->description('Profiles under initial review')
                ->descriptionIcon('heroicon-m-clock')
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

            Stat::make('Published Resources', Post::where('is_published', true)->count())
                ->description('Articles live on the site')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary')
                ->url('/admin/posts'),
        ];
    }
}
