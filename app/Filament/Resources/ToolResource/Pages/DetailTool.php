<?php

namespace App\Filament\Resources\ToolResource\Pages;

use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\ToolResource;
use Filament\Forms\Components\TextInput;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class DetailTool extends Page
{
    protected static string $resource = ToolResource::class;

    protected static string $view = 'filament.resources.tool-resource.pages.detail-tool';

    use InteractsWithRecord;

    public array $data = [];

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill([
            'name' => $this->record->name,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->disabled(),
            ])
            ->statePath('data');
    }
}