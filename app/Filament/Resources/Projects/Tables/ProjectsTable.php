<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                    
                TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                    
                TextColumn::make('year_of_creation')
                    ->label('Year Created')
                    ->sortable()
                    ->badge()
                    ->color('success'),
                    
                TextColumn::make('number_of_available_units')
                    ->label('Available Units')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                    
                TextColumn::make('owner_phone_number')
                    ->label('Owner Phone')
                    ->searchable()
                    ->placeholder('Not provided'),
                    
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('year_range')
                    ->form([
                        DatePicker::make('year_from')
                            ->label('From Year')
                            ->displayFormat('Y'),
                        DatePicker::make('year_to')
                            ->label('To Year')
                            ->displayFormat('Y'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['year_from'],
                                fn (Builder $query, $date): Builder => $query->whereYear('year_of_creation', '>=', $date),
                            )
                            ->when(
                                $data['year_to'],
                                fn (Builder $query, $date): Builder => $query->whereYear('year_of_creation', '<=', $date),
                            );
                    }),
                    
                SelectFilter::make('units_range')
                    ->label('Units Range')
                    ->options([
                        '1-50' => '1-50 units',
                        '51-100' => '51-100 units',
                        '101-200' => '101-200 units',
                        '200+' => '200+ units',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            function (Builder $query, string $value): Builder {
                                return match ($value) {
                                    '1-50' => $query->whereBetween('number_of_available_units', [1, 50]),
                                    '51-100' => $query->whereBetween('number_of_available_units', [51, 100]),
                                    '101-200' => $query->whereBetween('number_of_available_units', [101, 200]),
                                    '200+' => $query->where('number_of_available_units', '>', 200),
                                    default => $query,
                                };
                            }
                        );
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped();
    }
}
