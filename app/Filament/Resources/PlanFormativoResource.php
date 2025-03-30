<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanFormativoResource\Pages;
use App\Filament\Resources\PlanFormativoResource\RelationManagers;
use App\Models\Alumno;
use App\Models\Ciclo_formativo;
use App\Models\Curso;
use App\Models\Empresa;
use App\Models\Modulo;
use App\Models\Plan_formativo;
use App\Models\Ra;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PlanFormativoResource extends Resource
{
    protected static ?string $model = Plan_formativo::class;
    protected static ?string $navigationLabel = "Plan Formativo";
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationGroup = "Generador de documentos ffe";

    protected static ?string $navigationIcon = 'heroicon-c-gift';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('año_academico')
                ->options([
                    '2024/2025' => '2024/2025'
                ])
                ->required(),
                Select::make('regimen')
                ->options([
                    'General' => 'General',
                    'Intensivo' => 'Intensivo'
                ])->default('General')
                ->required(),

                Select::make('curso_id')
                ->label('Curso del alumno')
                ->relationship('curso','nombre')
                ->reactive()
                ->live()
                ->required(),


                Select::make('centro_educativo_id')
                ->label ('Centro educativo')
                ->relationship('centro_educativo','nombre')
                ->required(),

                Select::make('user_id')
                ->label('Profesor tutor ffe')
                ->options(fn(Get $get):Collection => User::query()->where('ciclo_formativo_id',Curso::query()->where('id',$get('curso_id'))->pluck('ciclo_formativo_id')->toArray())->pluck(DB::raw("CONCAT(name, ' ', apellidos) As nombre"),"id"))
                ->required(),

                Select::make('alumno_id')
                ->label('Alumno')
               ->options(function(Get $get):Collection {
                 $nombreapellidos = Alumno::query()->where('curso_id',$get('curso_id'))->pluck(DB::raw("CONCAT(nombre, ' ', apellidos) As nombre"),"id");
                 return $nombreapellidos;
               })
               ->unique(ignoreRecord: true)
                ->required(),
                Select::make('exencion_parcial')
                ->label('Exención parcial')
                ->options([
                    'Si' => 'Si',
                    'No' => 'No'
                ])->default('No')
                ->dehydrated()
                ->live(),
                TextInput::make('horas_exencion_parcial')
                ->label('Numero de horas de exencion parcial')
                ->required()
                ->default('sin exención')
                ->hidden(fn (Get $get) => $get('exencion_parcial') !== 'Si'),
                Select::make('realiza_ffe')
                ->label('Donde realiza las ffe')
                ->options([
                    'Una empresa' => 'Una empresa',
                    'Varias empresas' => 'Varias empresas'
                ])
                ->required(),

                Forms\Components\MarkdownEditor::make('coordinacion_seguimiento')
                ->label('Coordinación en el seguimiento del alumno')
                ->default('El seguimiento se hace presencial en la empresa cada semana, conversación telefónica, por la plataforma teams.')
                ->required(),
                Select::make('empresa_id')
                ->relationship('empresa','nombre')
                ->required(),

                Repeater::make('ras')
                ->label('Resultados de aprendizaje que dan en la empresa')
                ->relationship()
                ->schema([
                    Select::make('modulo_id')
                    ->label('Modulo')
                    ->reactive()
                    ->options(fn (callable $get) => Modulo::query()->where('curso_id',$get('../../curso_id'))->pluck('nombre','id'))
                    ->searchable(),
                    Select::make('ra_id')
                    ->label('Resultados de aprendizaje')
                    ->options(
                        fn (callable $get) => Ra::query()->where('modulo_id',$get('modulo_id'))->pluck('nombre','id')
                       //Ra::All()->pluck('nombre','id')
                    )
                    ->searchable(),
                ])
                ->columns(2),

                Select::make('apoyo')
                ->label('Necesidades de apoyo')
                ->options([
                    'Si' => 'Si',
                    'No' => 'No'
                ])->default('No')
                ->dehydrated()
                ->live()
                ->required(),
                Forms\Components\MarkdownEditor::make('especificar_apoyo')
                ->label('Especificar tipo de apoyo')
                ->required()
                ->default('Sin apoyo')
                ->hidden(fn (Get $get) => $get('apoyo') !== 'Si'),

                Select::make('autorizacion_extras')
                ->label('Autorizaciones extras')
                ->multiple()
                ->options([
                    'No' => 'No',
                    'Turnos' => 'Turnos',
                    'Periodos nocturnos' => 'Periodos nocturnos',
                    'Periodos no lectivos' => 'Periodos no lectivos',
                    'Periodos no calendario' => 'Periodos no calendario',
                    'Descanso semanal' => 'Descanso semanal',
                    'Movilidad internacional' => 'Movilidad internacional',
                    'Realiza fuera de la comunidad' => 'Realiza fuera de la comunidad',
                    'Otras' => 'Otras',
                ])->default('No')
                ->dehydrated()
                ->live()
                ->required(),

                Forms\Components\TextInput::make('numero_horas')
                ->Label('Numero de Horas Totales')
                ->required(),

                Select::make('distribucion')
                ->label('Distribución de las ffe')
                ->options([
                    'Semanal' => 'Semanal',
                    'Quincenal' => 'Quincenal',
                    'Mensual' => 'Mensual',
                    'Otros' => 'Otros',
                ])->default('Quincenal')
                ->required(),
                Forms\Components\DatePicker::make('fecha_inicio')
                ->label('Fecha de Inicio')
                ->required(),
                Forms\Components\DatePicker::make('fecha_fin')
                ->label('Fecha de Finalización')
                ->required(),
                Forms\Components\TimePicker::make('hora_inicio')
                ->label('Hora de entrada')
                ->seconds(false)
                ->required(),
                Forms\Components\TimePicker::make('hora_fin')
                ->label('Hora de salida')
                ->seconds(false)
                ->required(),
                Select::make('jornada')
                ->label('Jornada de trabajo')
                ->options([
                    '6h' => '6h',
                    '7h' => '7h',
                    '8h' => '8h',
                ])->default('8h')
                ->required(),

                Select::make('formacion_especifica')
                ->label('Formación especifica')
                ->options([
                    'Si' => 'Si',
                    'No' => 'No',
                ])->default('No')
                ->live()
                ->reactive()
                ->required(),

                Forms\Components\MarkdownEditor::make('descripcion_formacion_especifica')
                ->label('Descripción de la formación especifica')
                ->required()
                ->default('Sin formacion especifica')
                ->hidden(fn (Get $get) => $get('formacion_especifica') !== 'Si'),

                Forms\Components\DatePicker::make('fecha_firma')
                ->label('Fecha de firma del plan formativo')
                ->required(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('alumno.nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alumno.apellidos')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('empresa.nombre')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('curso_id')
                ->relationship('curso', 'nombre')
                ->searchable()
                ->preload()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('Plan formativo')
                ->url(fn($record):string => route('planformativo',$record))
                ->icon('heroicon-m-pencil-square')
                ->color('info')
                ->button(),
                Action::make('Relacion Alumnos')
                ->url(fn($record):string => route('relacion',$record))
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
            'index' => Pages\ListPlanFormativos::route('/'),
            'create' => Pages\CreatePlanFormativo::route('/create'),
            'edit' => Pages\EditPlanFormativo::route('/{record}/edit'),
        ];
    }





    }
