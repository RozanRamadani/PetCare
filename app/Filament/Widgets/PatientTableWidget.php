<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Patient;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class PatientTableWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Patient::query()
            )
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('type'),
            ]);
    }
}
