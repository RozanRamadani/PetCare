<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PatientResource;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

    use CreateRecord\Concerns\HasWizard;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Patient created';
    }

    protected function getSteps(): array
    {
        return[
            Step::make('Name Pet')
            ->description('Give a name to the pet')
            ->schema([
                PatientResource::getNameFormField()
            ]),
            Step::make('Date of Birth')
            ->description('Provide the patient\'s date of birth')
            ->schema([
                PatientResource::getDateOfBirthFormField()
            ]),
            Step::make('Type')
            ->description('Choose the patient\'s type')
            ->schema([
                PatientResource::getTypeFormField()
            ]),
            Step::make('Owner')
            ->description('Choose the pet owner')
            ->schema([
                PatientResource::getOwnerFormField()
            ])
        ];
    }
}
