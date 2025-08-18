<?php

namespace App\Filament\Resources\ToolResource\Pages;

use App\Models\Tool;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\ToolResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTools extends ListRecords
{
    protected static string $resource = ToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Tools')
                ->badge(Tool::query()->withTrashed()->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->withTrashed()),
            'active' => Tab::make('Active Tools')
                ->badge(Tool::query()->withoutTrashed()->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->withoutTrashed()),
            'inactive' => Tab::make('Inactive Tools')
                ->badge(Tool::query()->onlyTrashed()->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->onlyTrashed()),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'active';
    }
}
