<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CentroEducativoResource\Pages;
use App\Filament\Resources\CentroEducativoResource\RelationManagers;
use App\Models\Centro_educativo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CentroEducativoResource extends Resource
{
    protected static ?string $model = Centro_educativo::class;

    protected static ?string $navigationLabel = "Centro educativo";
    protected static ?string $navigationGroup = "Instituto";
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nif')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefono')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codigo_centro')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('localidad')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('provincia')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('calle')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codigo_postal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nombre_director')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellidos_director')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nif_director')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_director')
                    ->searchable(),
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
            'index' => Pages\ListCentroEducativos::route('/'),
            'create' => Pages\CreateCentroEducativo::route('/create'),
            'edit' => Pages\EditCentroEducativo::route('/{record}/edit'),
        ];
    }
}
