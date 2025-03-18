<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcuerdoResource\Pages;
use App\Filament\Resources\AcuerdoResource\RelationManagers;
use App\Models\Acuerdo;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AcuerdoResource extends Resource
{
    protected static ?string $model = Acuerdo::class;
    protected static ?string $navigationLabel = "Acuerdos";
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationGroup = "Generador de documentos ffe";

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('acuerdo_numero')

                    ->required(),
                Select::make('centro_educativo_id')
                    ->relationship('centro_educativo','nombre')
                    ->required(),
                Select::make('empresa_id')
                    ->relationship('empresa','nombre')
                    ->unique(ignoreRecord: true)
                    ->required(),
                Select::make('seguridad_social')
                    ->options([
                    'JCYL' => 'JCYL',
                    'Empresa' => 'Empresa'
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('acuerdo_fecha')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('acuerdo_numero')
                    ->searchable(),

                Tables\Columns\TextColumn::make('empresa.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('seguridad_social')
                    ->sortable(),
                Tables\Columns\TextColumn::make('acuerdo_fecha')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            Action::make('Acuerdo')
                ->url(fn($record):string => route('acuerdo',$record))
                ->icon('heroicon-m-pencil-square')
                ->color('info')
                ->button(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcuerdos::route('/'),
            'create' => Pages\CreateAcuerdo::route('/create'),
            'edit' => Pages\EditAcuerdo::route('/{record}/edit'),
        ];
    }
}
