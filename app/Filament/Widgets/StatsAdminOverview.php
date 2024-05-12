<?php

namespace App\Filament\Widgets;

use App\Models\Team;
use App\Models\User;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsAdminOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';



    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::query()->count())
                ->description('All Users form Data Baes')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Teams', Team::query()->count())
                ->description('All Teams form Data Baes')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Employees ', Employee::query()->count())
                ->description('All Employees  form Data Baes')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
