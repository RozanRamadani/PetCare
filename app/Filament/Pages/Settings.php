<?php

namespace App\Filament\Pages;

use App\Filament\Resources\OwnerResource;
use App\Filament\Resources\PatientResource;
use App\Filament\Resources\ToolResource;
use Filament\Pages\Page;
use Filament\Actions\Action;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static ?string $activeNavigationIcon = 'heroicon-s-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        return auth()->user()->id == 1;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Tools')
                ->action(fn() => redirect()->to(ToolResource::getUrl('index'))),
            Action::make('Owners')
                ->action(fn() => redirect()->to(OwnerResource::getUrl('index'))),
            Action::make('Patients')
                ->action(fn() => redirect()->to(PatientResource::getUrl('index'))),
        ];
    }
}
