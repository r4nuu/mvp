<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Project Name')
                    ->required()
                    ->maxLength(255),
                    
                Textarea::make('address')
                    ->label('Project Address')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                    
                TextInput::make('year_of_creation')
                    ->label('Year of Creation')
                    ->required()
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(now()->year)
                    ->placeholder('e.g., 2020'),
                    
                TextInput::make('number_of_available_units')
                    ->label('Number of Available Units')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->placeholder('e.g., 50'),
                    
                TextInput::make('owner_phone_number')
                    ->label('Owner Phone Number (Optional)')
                    ->tel()
                    ->placeholder('Optional')
                    ->maxLength(20),
            ]);
    }
}
