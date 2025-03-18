<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModulosResource\Pages;
use App\Filament\Resources\ModulosResource\RelationManagers;
use App\Models\Modulo;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModulosResource extends Resource
{
    protected static ?string $model = Modulo::class;

    protected static ?string $navigationLabel = "Modulos";
    protected static ?string $navigationGroup = "Instituto";
    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-m-light-bulb';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('descripcion')
                    ->label('Descripción'),
                Select::make('curso_id')
                ->relationship('curso','nombre')
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('curso.nombre')
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
            'index' => Pages\ListModulos::route('/'),
            'create' => Pages\CreateModulos::route('/create'),
            'edit' => Pages\EditModulos::route('/{record}/edit'),
        ];
    }
}
