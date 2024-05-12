<?php

namespace App\Filament\App\Widgets;

use App\Models\Employee;
use Flowframe\Trend\Trend;
use Filament\Facades\Filament;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class EmployeeAppChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $color = 'warning';
    protected static ?int $sort = 2;

    // protected static ?string $maxHeight = '100%';
    protected function getData(): array
    {
        $data = Trend::query(Employee::query()->whereBelongsTo(Filament::getTenant()))
            ->between(
                start: now()->startOfWeek(),
                end: now()->endOfWeek(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Employees',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
