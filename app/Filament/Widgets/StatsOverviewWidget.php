<?php

namespace App\Filament\Widgets;

use App\Models\Admission;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('Enrolled students')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total Teachers', Teacher::where('is_active', true)->count())
                ->description('Active faculty members')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info')
                ->chart([3, 6, 5, 8, 7, 9, 10]),

            Stat::make('Active Courses', Course::where('is_active', true)->count())
                ->description('Currently offered')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary')
                ->chart([2, 4, 3, 5, 6, 4, 8]),

            Stat::make('Pending Admissions', Admission::where('status', 'pending')->count())
                ->description('Awaiting review')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning')
                ->chart([1, 3, 2, 5, 4, 7, 6]),

            Stat::make('Unread Messages', Contact::where('status', 'unread')->count())
                ->description('New contact messages')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
        ];
    }
}
