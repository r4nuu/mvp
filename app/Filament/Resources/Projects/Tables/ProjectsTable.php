<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    
                TextColumn::make('total_units_count')
                    ->label('Total Units')
                    ->getStateUsing(fn ($record): int => $record->units()->count())
                    ->badge()
                    ->color('info'),
                    
                TextColumn::make('available_units_count')
                    ->label('Available')
                    ->getStateUsing(fn ($record): int => $record->units()->where('status', 'available')->count())
                    ->badge()
                    ->color('success'),
                    
                TextColumn::make('reserved_units_count')
                    ->label('Reserved')
                    ->getStateUsing(fn ($record): int => $record->units()->where('status', 'reserved')->count())
                    ->badge()
                    ->color('warning'),
                    
                TextColumn::make('sold_units_count')
                    ->label('Sold')
                    ->getStateUsing(fn ($record): int => $record->units()->where('status', 'sold')->count())
                    ->badge()
                    ->color('danger'),
                    
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
                //
            ])
            ->recordActions([
                EditAction::make(),
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
