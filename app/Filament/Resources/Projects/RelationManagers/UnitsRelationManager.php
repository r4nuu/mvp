<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class UnitsRelationManager extends RelationManager
{
    protected static string $relationship = 'units';

    protected static ?string $recordTitleAttribute = 'unit_number';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('unit_number')
            ->columns([
                Tables\Columns\TextColumn::make('unit_number')
                    ->label('Unit Number')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('building')
                    ->label('Building')
                    ->placeholder('Not specified'),
                    
                Tables\Columns\TextColumn::make('floor')
                    ->label('Floor')
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                    
                Tables\Columns\TextColumn::make('area')
                    ->label('Area')
                    ->numeric(decimalPlaces: 2)
                    ->suffix(' m²')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('USD')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'reserved' => 'warning',
                        'sold' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'available' => 'Available',
                        'reserved' => 'Reserved',
                        'sold' => 'Sold',
                    ]),
            ])
            ->defaultSort('unit_number');
    }
}
