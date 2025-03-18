<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpresaResource\Pages;
use App\Filament\Resources\EmpresaResource\RelationManagers;
use App\Models\Empresa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationLabel = "Empresas";
    protected static ?string $navigationGroup = "Fase de formacion en empresa";
    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')

                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nif')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('localidad')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('provincia')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codigo_postal')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('calle')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nombre_tutor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellidos_tutor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nif_tutor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email_tutor')
                    ->email()
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
                Tables\Columns\TextColumn::make('nif')
                    ->searchable(),
                Tables\Columns\TextColumn::make('localidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provincia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('codigo_postal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('calle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_tutor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellidos_tutor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nif_tutor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_tutor')
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
            'index' => Pages\ListEmpresas::route('/'),
            'create' => Pages\CreateEmpresa::route('/create'),
            'edit' => Pages\EditEmpresa::route('/{record}/edit'),
        ];
    }
}
