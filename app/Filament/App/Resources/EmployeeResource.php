<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\EmployeeResource\Pages;
use Filament\Infolists\Components\Section as Section_info;
use App\Filament\App\Resources\EmployeeResource\RelationManagers;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Name")->schema([
                    Select::make('user_id')
                        ->relationship('user', 'name',)
                        // ->options(User::all()->whereNotIn("id","user_id")->pluck("name", "id"))

                        ->required()
                        ->label("User Name ")
                        ->unique(ignoreRecord: true)
                        ->columnSpanFull(),
                ])->columns("1"),
                Section_info::make("address")->schema([
                    Select::make('country_id')
                        ->relationship('country', 'name')
                        ->required(),
                    Select::make('state_id')
                        ->required()
                        ->relationship('state', 'name'),
                    Select::make('city_id')
                        ->relationship('city', 'name')
                        ->required(),
                    Select::make('department_id')
                        ->required()
                        ->relationship('department', 'name')
                        ->preload(),
                ])->columns("2"),
                Section::make("User address")->schema([
                    TextInput::make('address')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('zip_code')
                        ->required()
                        ->maxLength(255),
                ])->columns("2"),
                Section::make("date")->schema([
                    DatePicker::make('date_of_birth')
                        ->required(),
                    DatePicker::make('date_hired')
                        ->required(),
                ])->columns("2"),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->listWithLineBreaks()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.id')
                    ->label("User ID")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label("User Name")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label("Email")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.first_name')
                    ->label("First Name")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.middle_name')
                    ->label("Middle Name")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.last_name')
                    ->label("Last Name")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_hired')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make("Country")
                    ->relationship("country", "name")
                    ->searchable('name')
                    ->preload(),
                SelectFilter::make("State")
                    ->relationship("state", "name")
                    ->searchable('name')
                    ->preload(),
                SelectFilter::make("City")
                    ->relationship("city", "name")
                    ->searchable('name')
                    ->preload(),
                SelectFilter::make("Department")
                    ->relationship("department", "name")
                    ->searchable('name')
                    ->preload(),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])->columnSpan(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['from'])->toFormattedDateString())
                                ->removeField('from');
                        }
                        if ($data['until'] ?? null) {
                            $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['until'])->toFormattedDateString())
                                ->removeField('until');
                        }
                        return $indicators;
                    })->columns(2)
            ], layout: FiltersLayout::Modal)
            ->filtersFormColumns(2)
            ->filtersFormMaxHeight('400px')
            ->filtersFormWidth(MaxWidth::FourExtraLarge)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section_info::make("User Name Info")->schema([
                    TextEntry::make('user.name'),

                    TextEntry::make('user.first_name'),
                    TextEntry::make('user.last_name'),
                    TextEntry::make('user.middle_name'),
                ])->columns(2),
                Section_info::make("Address Info")->schema([
                    TextEntry::make('country.name'),
                    TextEntry::make('state.name'),
                    TextEntry::make('city.name '),
                    TextEntry::make('department.name'),
                ])->columns(2),
                Section_info::make("User Address Info")->schema([
                    TextEntry::make('address'),
                    TextEntry::make('zip_code'),
                ])->columns(2),
                Section_info::make("Date Info")->schema([
                    TextEntry::make('date_of_birth'),
                    TextEntry::make('date_hired'),
                ])->columns(2),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
