<?php

namespace App\Filament\Staff\Resources\ToolResource\Pages;

use App\Filament\Staff\Resources\ToolResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTools extends ListRecords
{
    protected static string $resource = ToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
