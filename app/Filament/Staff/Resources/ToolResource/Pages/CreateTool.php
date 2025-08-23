<?php

namespace App\Filament\Staff\Resources\ToolResource\Pages;

use App\Filament\Staff\Resources\ToolResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTool extends CreateRecord
{
    protected static string $resource = ToolResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Tool created';
    }
}
