<?php

namespace App\Filament\Resources\StateResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Name")->schema([
                    Select::make('user_name')
                        ->relationship('user', 'name')
                        ->required()
                        ->disabled()
                        ->label("User Name ")
                        ->unique(ignoreRecord: true)
                        ->columnSpanFull(),
                ])->columns("1"),
                Section::make("address")->schema([
                    Select::make('country_id')
                        ->relationship('country', 'name')
                        ->required(),
                    Select::make('state_id')
                        ->disabled()
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('country.name')
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
