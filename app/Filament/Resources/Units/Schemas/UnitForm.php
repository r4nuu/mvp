<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->label('Project')
                    ->relationship('project', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
                    
                TextInput::make('unit_number')
                    ->label('Unit Number/Name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g., A-101, Unit 205'),
                    
                TextInput::make('building')
                    ->label('Building')
                    ->placeholder('e.g., Block A, Tower 1')
                    ->maxLength(255),
                    
                TextInput::make('floor')
                    ->label('Floor')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(200)
                    ->placeholder('e.g., 5'),
                    
                TextInput::make('view')
                    ->label('View')
                    ->placeholder('e.g., Sea View, Garden View, City View')
                    ->maxLength(255),
                    
                TextInput::make('area')
                    ->label('Area (sq m)')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->step(0.01)
                    ->placeholder('e.g., 85.5'),
                    
                TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->prefix('$')
                    ->placeholder('e.g., 250000'),
                    
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Available',
                        'reserved' => 'Reserved',
                        'sold' => 'Sold'
                    ])
                    ->default('available')
                    ->required(),
            ]);
    }
}
