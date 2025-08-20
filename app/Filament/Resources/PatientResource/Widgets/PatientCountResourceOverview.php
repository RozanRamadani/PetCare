<?php

namespace App\Filament\Resources\PatientResource\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PatientCountResourceOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected function getStats(): array
    {
        return [
            Stat::make('Total Patients', Patient::count())
                ->label('Total Patients')
                ->color('primary')
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
