<?php

namespace App\Filament\Staff\Resources\PatientResource\Pages;

use App\Filament\Staff\Resources\PatientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;
}
