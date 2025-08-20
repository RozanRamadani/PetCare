<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PatientResource;
use App\Filament\Resources\PatientResource\Widgets\PatientCountByTypeChart;
use App\Filament\Resources\PatientResource\Widgets\PatientCountResourceOverview;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PatientCountResourceOverview::class,
            PatientCountByTypeChart::class,
        ];
    }
}
