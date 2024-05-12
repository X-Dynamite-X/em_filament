<?php

namespace App\Filament\App\Widgets;

use App\Models\Team;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsAppOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Users', Team::find(Filament::getTenant())->first()->members->count())
                ->description('All Users form Data Baes')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Departments', Department::query()
            ->whereBelongsTo(Filament::getTenant())
            ->count())
                ->description('All Departments form Data Baes')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Employees ', Employee::query()
            ->whereBelongsTo(Filament::getTenant())
            ->count())
                ->description('All Employees  form Data Baes')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
