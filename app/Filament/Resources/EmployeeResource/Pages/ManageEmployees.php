<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ManageEmployees extends ManageRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'The Week' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('date_hired', ">=", now()->subWeek()))
                ->badge(Employee::query()->where('date_hired', ">=", now()->subWeek())->count()),


            'The Month' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('date_hired', ">=", now()->subMonth()))
                ->badge(Employee::query()->where('date_hired', ">=", now()->subWeek())->count()),

            'The Year' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('date_hired', ">=", now()->subYear()))
                ->badge(Employee::query()->where('date_hired', ">=", now()->subYear())->count()),


        ];
    }
}
