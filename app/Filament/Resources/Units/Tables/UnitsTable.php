<?php

namespace App\Filament\Resources\Units\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;

class UnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                    
                TextColumn::make('unit_number')
                    ->label('Unit Number')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                    
                TextColumn::make('building')
                    ->label('Building')
                    ->searchable()
                    ->placeholder('Not specified'),
                    
                TextColumn::make('floor')
                    ->label('Floor')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                    
                TextColumn::make('view')
                    ->label('View')
                    ->searchable()
                    ->placeholder('Not specified'),
                    
                TextColumn::make('area')
                    ->label('Area (sq m)')
                    ->numeric(decimalPlaces: 2)
                    ->sortable()
                    ->suffix(' m²'),
                    
                TextColumn::make('price')
                    ->label('Price')
                    ->money('USD')
                    ->sortable(),
                    
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'reserved' => 'warning',
                        'sold' => 'danger',
                        default => 'gray',
                    }),
                    
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
                SelectFilter::make('project_id')
                    ->label('Project')
                    ->relationship('project', 'name')
                    ->searchable()
                    ->preload(),
                    
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Available',
                        'reserved' => 'Reserved',
                        'sold' => 'Sold',
                    ]),
                    
                Filter::make('price_range')
                    ->form([
                        TextInput::make('price_from')
                            ->label('Price From')
                            ->numeric()
                            ->prefix('$'),
                        TextInput::make('price_to')
                            ->label('Price To')
                            ->numeric()
                            ->prefix('$'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price_from'],
                                fn (Builder $query, $price): Builder => $query->where('price', '>=', $price),
                            )
                            ->when(
                                $data['price_to'],
                                fn (Builder $query, $price): Builder => $query->where('price', '<=', $price),
                            );
                    }),
                    
                Filter::make('area_range')
                    ->form([
                        TextInput::make('area_from')
                            ->label('Area From (sq m)')
                            ->numeric()
                            ->step(0.01),
                        TextInput::make('area_to')
                            ->label('Area To (sq m)')
                            ->numeric()
                            ->step(0.01),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['area_from'],
                                fn (Builder $query, $area): Builder => $query->where('area', '>=', $area),
                            )
                            ->when(
                                $data['area_to'],
                                fn (Builder $query, $area): Builder => $query->where('area', '<=', $area),
                            );
                    }),
            ])
            ->recordActions([
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
