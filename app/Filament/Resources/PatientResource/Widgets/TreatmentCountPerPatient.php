<?php

namespace App\Filament\Resources\PatientResource\Widgets;

use App\Models\Treatment;
use Illuminate\Database\Eloquent\Model;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TreatmentCountPerPatient extends BaseWidget
{
    public ?Model $record = null;
    
    protected function getStats(): array
    {
        return [
            Stat::make('Total Treatments', Treatment::where('patient_id', $this->record->id)->count()),
        ];
    }
}
