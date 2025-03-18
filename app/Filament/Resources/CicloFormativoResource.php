<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CicloFormativoResource\Pages;
use App\Filament\Resources\CicloFormativoResource\RelationManagers;
use App\Models\Ciclo_formativo;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CicloFormativoResource extends Resource
{
    protected static ?string $model = Ciclo_formativo::class;
    protected static ?string $navigationLabel = "Ciclos Formativos";
    protected static ?string $navigationGroup = "Instituto";
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Select::make('tipo')
                ->options([
                    'CE' => 'CE',
                    'CFGS' => 'CFGS',
                    'CFGM' => 'CFGM',
                    'FPB' => 'FPB'
                ]),
                Select::make('departamento_id')
                ->relationship('departamento','nombre')
                ->preload()
                ->required(),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departamento.nombre')
                    ->searchable(),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCicloFormativos::route('/'),
            'create' => Pages\CreateCicloFormativo::route('/create'),
            'edit' => Pages\EditCicloFormativo::route('/{record}/edit'),
        ];
    }
}
