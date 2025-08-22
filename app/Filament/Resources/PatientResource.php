<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Patient;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\PatientResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Filament\Resources\PatientResource\RelationManagers\TreatmentsRelationManager;
use App\Filament\Resources\PatientResource\Widgets\PatientCountByTypeChart;
use App\Filament\Resources\PatientResource\Widgets\PatientCountResourceOverview;
use App\Filament\Resources\PatientResource\Widgets\TreatmentCountPerPatient;
use App\Filament\Widgets\PatientCountOverview;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Data';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
    }

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationBadgeTooltip = 'Total number of patients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                static::getNameFormField(),
                static::getTypeFormField(),
                static::getDateOfBirthFormField(),
                static::getOwnerFormField(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('type'),
                TextColumn::make('date_of_birth')
                    ->sortable(),
                TextColumn::make('owner.name')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'cat' => 'Cat',
                        'dog' => 'Dog',
                        'rabbit' => 'Rabbit',
                        'bird' => 'Bird',
                    ]),
                SelectFilter::make('owner_id')
                    ->label('Owner')
                    ->relationship('owner', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TreatmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }

    public static function getNameFormField(): TextInput
    {
        return TextInput::make('name')
            ->required()
            ->maxLength(255);
    }

    public static function getTypeFormField(): Select
    {
        return Select::make('type')
            ->options([
                'cat' => 'Cat',
                'dog' => 'Dog',
                'rabbit' => 'Rabbit',
            ])
            ->required();
    }

    public static function getDateOfBirthFormField(): DatePicker
    {
        return DatePicker::make('date_of_birth')
            ->required()
            ->maxDate(now());
    }

    public static function getOwnerFormField(): Select
    {
        return Select::make('owner_id')
            ->relationship('owner', 'name')
            ->preload()
            ->createOptionForm([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Phone number')
                    ->tel()
                    ->required(),
            ])
            ->required();
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Owner' => $record->owner->name,
            'Type' => $record->type,
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()
            ->with(['owner']);
    }

    public static function getWidgets(): array
    {
        return [
            PatientCountResourceOverview::class,
            PatientCountByTypeChart::class,
            TreatmentCountPerPatient::class,
        ];
    }

}
