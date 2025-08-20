<?php

namespace App\Filament\Resources\PatientResource\Widgets;

use App\Models\Patient;
use Filament\Widgets\ChartWidget;

class PatientCountByTypeChart extends ChartWidget
{
    protected static ?string $heading = 'Patient By Type';

    protected function getData(): array
    {
        $data = Patient::query()
        ->selectRaw('type, count(*) as total')
        ->groupBy('type')
        ->get()
        ->toArray();
        return [
            'datasets' => [
                [
                    'label' => 'total',
                    'data' => collect($data)->pluck('total'),
                ],
            ],
            'labels' => collect($data)->pluck('type'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
