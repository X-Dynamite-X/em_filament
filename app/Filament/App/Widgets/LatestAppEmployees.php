<?php

namespace App\Filament\App\Widgets;

use Filament\Tables;
use App\Models\Employee;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAppEmployees extends BaseWidget
{
    protected static ?int $sort = 3;
    // protected String | array | int $columnSpan = "full";


    public function table(Table $table): Table
    {
        return $table
            ->query(Employee::query()->whereBelongsTo(Filament::getTenant()))
            ->defaultSort("created_at","desc")
            ->columns([
                TextColumn::make("country.name")
                ->label("Country Name "),
                TextColumn::make("user.name")
                ->label("User Name "),
                TextColumn::make("user.email")
                ->label("Email"),
                TextColumn::make("user.first_name")
                ->label("First Name"),

                TextColumn::make("user.last_name")
                ->label("Last Name"),



            ]);
    }
}

