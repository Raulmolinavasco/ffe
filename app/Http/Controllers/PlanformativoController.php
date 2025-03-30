<?php

namespace App\Http\Controllers;

use App\Models\Acuerdo;
use App\Models\Centro_educativo as ModelsCentro_educativo;
use App\Models\Centro_educativo;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Plan_formativo;
use App\Models\Plan_formativora;
use App\Models\Ra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PHPUnit\Event\Code\Throwable;

class PlanformativoController extends Controller
{
    public function Planformativo($record)
    {

        $planformativo = Plan_formativo::where('id', $record)->get();
        $acuerdo = Acuerdo::where('empresa_id',$planformativo[0]->empresa_id)->pluck('acuerdo_numero');

        $fileName = "planformativo.docx";
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/template/' . $fileName));

        $templateProcessor->setValue('acuerdo', $acuerdo[0]);
        $templateProcessor->setValue('año_academico', $planformativo[0]->año_academico);

        if (strpos($planformativo[0]->curso->nombre, '1') !== false) {
            $templateProcessor->setValue('curso', '■');
            $templateProcessor->setValue('curso1', '□');
        } else {
            $templateProcessor->setValue('curso', '□');
            $templateProcessor->setValue('curso1', '■');
        }

        if ($planformativo[0]->regimen == 'General') {
            $templateProcessor->setValue('regimen', '■');
            $templateProcessor->setValue('regimen1', '□');
        } else {
            $templateProcessor->setValue('regimen', '□');
            $templateProcessor->setValue('regimen1', '■');
        }

        if ($planformativo[0]->curso->ciclo_formativo->grado == "D") {
            $templateProcessor->setValue('gradod', '■');
            $templateProcessor->setValue('gradoe', '□');
        } else {
            $templateProcessor->setValue('gradod', '□');
            $templateProcessor->setValue('gradoe', '■');
        }

        $templateProcessor->setValue('ciclo_formativo', $planformativo[0]->curso->ciclo_formativo->nombre);
        $templateProcessor->setValue('codigo', $planformativo[0]->curso->ciclo_formativo->codigo);
        $templateProcessor->setValue('ciclo_formativo', $planformativo[0]->curso->ciclo_formativo->nombre);

        $templateProcessor->setValue('nombre_centro_educativo', $planformativo[0]->centro_educativo->nombre);
        $templateProcessor->setValue('codigocentro', $planformativo[0]->centro_educativo->codigo_centro);
        $templateProcessor->setValue('nif_centro', $planformativo[0]->centro_educativo->nif);
        $templateProcessor->setValue('email_centro', $planformativo[0]->centro_educativo->email);
        $templateProcessor->setValue('telefono_centro', $planformativo[0]->centro_educativo->telefono);

        $templateProcessor->setValue('nombre_tutor', $planformativo[0]->user->name);
        $templateProcessor->setValue('apellidos_tutor', $planformativo[0]->user->apellidos);
        $templateProcessor->setValue('email_tutor', $planformativo[0]->user->email);

        $templateProcessor->setValue('nombre_alumno', $planformativo[0]->alumno->nombre);
        $templateProcessor->setValue('apellidos_alumno', $planformativo[0]->alumno->apellidos);
        $templateProcessor->setValue('nif_alumno', $planformativo[0]->alumno->nif);
        $templateProcessor->setValue('telefono_alumno', $planformativo[0]->alumno->telefono);
        $templateProcessor->setValue('email_alumno', $planformativo[0]->alumno->email);
        $templateProcessor->setValue('nuss_alumno', $planformativo[0]->alumno->nuss);

        if ($planformativo[0]->exencion_parcial == "No") {
            $templateProcessor->setValue('exencionno', '■');
            $templateProcessor->setValue('exencionsi', '□');
        } else {
            $templateProcessor->setValue('exencionno', '□');
            $templateProcessor->setValue('exencionsi', '■');
        }
        $templateProcessor->setValue('horas_exencion', $planformativo[0]->horas_exencion_parcial);
        if ($planformativo[0]->realiza_ffe == "Una empresa") {
            $templateProcessor->setValue('empresasi', '■');
            $templateProcessor->setValue('empresano', '□');
        } else {
            $templateProcessor->setValue('empresasi', '□');
            $templateProcessor->setValue('empresano', '■');
        }
        $templateProcessor->setValue('coordinacion_seguimiento', $planformativo[0]->coordinacion_seguimiento);

        //tablas de RA


        $templateProcessor->setValue('nombre_empresa', $planformativo[0]->empresa->nombre);
        $templateProcessor->setValue('nif_empresa', $planformativo[0]->empresa->nif);
        $templateProcessor->setValue('email_empresa', $planformativo[0]->empresa->email);
        $templateProcessor->setValue('telefono_empresa', $planformativo[0]->empresa->telefono);
        $templateProcessor->setValue('nombre_tutor_empresa', $planformativo[0]->empresa->nombre_tutor);
        $templateProcessor->setValue('apellidos_tutor_empresa', $planformativo[0]->empresa->apellidos_tutor);
        $templateProcessor->setValue('email_tutor_empresa', $planformativo[0]->empresa->email_tutor);
        $templateProcessor->setValue('horas_exencion', $planformativo[0]->horas_exencion_parcial);
        if ($planformativo[0]->apoyo == "No") {
            $templateProcessor->setValue('apoyossi', '■');
            $templateProcessor->setValue('apoyosno', '□');
        } else {
            $templateProcessor->setValue('apoyossi', '□');
            $templateProcessor->setValue('apoyosno', '■');
        }
        $templateProcessor->setValue('especificar_apoyo', $planformativo[0]->especificar_apoyo);
        if ($planformativo[0]->autorizacion_extras == "No") {
            $templateProcessor->setValue('autorizacionno', '■');
            $templateProcessor->setValue('autorizacionsi', '□');
        }
        if ($planformativo[0]->autorizacion_extras == "Turnos") {
            $templateProcessor->setValue('autorizacionno', '□');
            $templateProcessor->setValue('autorizacionsi', '■');
            $templateProcessor->setValue('turno', '■');
        } else {
            $templateProcessor->setValue('turno', '□');
        }
        if ($planformativo[0]->autorizacion_extras == "Periodos nocturnos") {
            $templateProcessor->setValue('autorizacionno', '□');
            $templateProcessor->setValue('autorizacionsi', '■');
            $templateProcessor->setValue('nocturno', '■');
        } else {
            $templateProcessor->setValue('nocturno', '□');
        }
        if ($planformativo[0]->autorizacion_extras == "Periodos no lectivos") {
            $templateProcessor->setValue('autorizacionno', '□');
            $templateProcessor->setValue('autorizacionsi', '■');
            $templateProcessor->setValue('lectivo', '■');
        } else {
            $templateProcessor->setValue('lectivo', '□');
        }
        if ($planformativo[0]->autorizacion_extras == "Periodos no calendario") {
            $templateProcessor->setValue('autorizacionno', '□');
            $templateProcessor->setValue('autorizacionsi', '■');
            $templateProcessor->setValue('escolar', '■');
        } else {
            $templateProcessor->setValue('escolar', '□');
        }
        if ($planformativo[0]->autorizacion_extras == "Descanso semanal") {
            $templateProcessor->setValue('autorizacionno', '□');
            $templateProcessor->setValue('autorizacionsi', '■');
            $templateProcessor->setValue('descanso', '■');
        } else {
            $templateProcessor->setValue('descanso', '□');
        }
        if ($planformativo[0]->autorizacion_extras == "Movilidad internacional") {
            $templateProcessor->setValue('autorizacionno', '□');
            $templateProcessor->setValue('autorizacionsi', '■');
            $templateProcessor->setValue('internacional', '■');
        } else {
            $templateProcessor->setValue('internacional', '□');
        }
        if ($planformativo[0]->autorizacion_extras == "Realiza fuera de la comunidad") {
            $templateProcessor->setValue('autorizacionno', '□');
            $templateProcessor->setValue('autorizacionsi', '■');
            $templateProcessor->setValue('comunidad', '■');
        } else {
            $templateProcessor->setValue('comunidad', '□');
        }
        if ($planformativo[0]->autorizacion_extras == "Otras") {
            $templateProcessor->setValue('autorizacionno', '□');
            $templateProcessor->setValue('autorizacionsi', '■');
            $templateProcessor->setValue('otros', '■');
        } else {
            $templateProcessor->setValue('otros', '□');
        }



        $templateProcessor->setValue('numero_horas', $planformativo[0]->numero_horas);

        if ($planformativo[0]->distribucion == "Semanal") {
            $templateProcessor->setValue('semanal', '■');
            $templateProcessor->setValue('quincenal', '□');
            $templateProcessor->setValue('mensual', '□');
            $templateProcessor->setValue('otrosdis', '□');
        }
        if ($planformativo[0]->distribucion == "Quincenal") {
            $templateProcessor->setValue('semanal', '□');
            $templateProcessor->setValue('quincenal', '■');
            $templateProcessor->setValue('mensual', '□');
            $templateProcessor->setValue('otrosdis', '□');
        }
        if ($planformativo[0]->distribucion == "Mensual") {
            $templateProcessor->setValue('semanal', '□');
            $templateProcessor->setValue('quincenal', '□');
            $templateProcessor->setValue('mensual', '■');
            $templateProcessor->setValue('otrosdis', '□');
        }
        if ($planformativo[0]->distribucion == "Otros") {
            $templateProcessor->setValue('semanal', '□');
            $templateProcessor->setValue('quincenal', '□');
            $templateProcessor->setValue('mensual', '□');
            $templateProcessor->setValue('otrosdis', '■');
        }

        $templateProcessor->setValue('fecha_inicio', $planformativo[0]->fecha_inicio);
        $templateProcessor->setValue('fecha_fin', $planformativo[0]->fecha_fin);
        $templateProcessor->setValue('hora_inicio', $planformativo[0]->hora_inicio);
        $templateProcessor->setValue('hora_fin', $planformativo[0]->hora_fin);

        if ($planformativo[0]->jornada == "6h") {
            $templateProcessor->setValue('6h', '■');
            $templateProcessor->setValue('7h', '□');
            $templateProcessor->setValue('8h', '□');
        }
        if ($planformativo[0]->jornada == "7h") {

            $templateProcessor->setValue('6h', '□');
            $templateProcessor->setValue('7h', '■');
            $templateProcessor->setValue('8h', '□');
        }
        if ($planformativo[0]->jornada == "8h") {

            $templateProcessor->setValue('6h', '□');
            $templateProcessor->setValue('7h', '□');
            $templateProcessor->setValue('8h', '■');
        }

        if ($planformativo[0]->formacionespecifica == "Si") {
            $templateProcessor->setValue('formacion_especificasi', '■');
            $templateProcessor->setValue('formacion_especificano', '□');
        } else {
            $templateProcessor->setValue('formacion_especificano', '■');
            $templateProcessor->setValue('formacion_especificasi', '□');
        }
        $templateProcessor->setValue('descripcion_formacion_especifica', $planformativo[0]->descripcion_formacion_especifica);
        $templateProcessor->setCheckbox('prueba', true);

        $table = new Table(array('cellMargin' => 0, 'borderSize' => 12, 'borderColor' => 'green', 'width' => 9700, 'unit' => TblWidth::TWIP));
        $table->addRow();
        $myFontStyle = array('name' => 'Calibri bold', 'size' => 10, 'bold' => true, 'valign' => 'center');

        $table->addCell(2000, ['bgColor' => 'bfbfbf'])->addText('PLANIFICACIÓN DE LOS RESULTADOS DE APRENDIZAJE DEL CICLO FORMATIVO/CURSO DE ESPECIALIZACIÓN PARA SU DESARROLLO EN LA FASE DE FORMACIÓN EN EMPRESA A LO LARGO DE TODA LA FORMACIÓN', $myFontStyle);
        $table->addRow();
        $table->addCell(130, ['bgColor' => 'd9d9d9'])->addText('MÓDULO PROFESIONAL', $myFontStyle);
        $table->addCell(70, ['bgColor' => 'd9d9d9'])->addText('CÓDIGO', $myFontStyle);
        $table->addCell(350, ['bgColor' => 'd9d9d9'])->addText('RESULTADOS DE APRENDIZAJE', $myFontStyle);
        $table->addCell(70, ['bgColor' => 'd9d9d9'])->addText('CENTRO', $myFontStyle);
        $table->addCell(70, ['bgColor' => 'd9d9d9'])->addText('EMPRESA', $myFontStyle);


        $cicloformativo = Curso::where('id', $planformativo[0]->curso_id)->pluck('ciclo_formativo_id');
        $cursos = Curso::Where('ciclo_formativo_id', $cicloformativo)->pluck('id');
        // dd($cursos);
        foreach ($cursos as $curso) {
            $modulos = Modulo::where('curso_id', $curso)->get();
            // dd($modulos);
            $datos = $planformativo[0];

            foreach ($modulos as $dato) {
                $table->addRow();
                $table->addCell(130)->addText($dato->nombre, ['valign' => 'top', 'bold' => true]);
                $table->addCell(70)->addText($dato->codigo, ['valign' => 'top', 'bold' => true]);
                $ratablas = Ra::where('modulo_id', $dato->id)->get();
                $cell = $table->addCell(150);
                $nestedTable = $cell->addTable(array('cellMargin' => 0, 'alignment' => Jc::CENTER, 'valign' => 'center'));
                //  $textRun = $cell->addTextRun();
                foreach ($ratablas as $dato) {
                    $nestedTable = $cell->addTable(array('cellMargin' => 0, 'borderSize' => 0, 'spacing' => 0, 'borderColor' => 'green', 'unit' => TblWidth::TWIP, 'alignment' => JcTable::CENTER));
                    $nestedTable->addRow();
                    $nestedTable->addCell(20)->addText($dato->nombre, ['valign' => 'top', 'bold' => true]);
                    $nestedTable->addCell(100)->addText($dato->descripcion, ['valign' => 'top', 'size' => 6]);
                    $planformativoId = $planformativo[0]->id;
                    $raId = $dato->id;
                    $planformativora = Plan_formativora::where('plan_formativo_id', $planformativoId)->where('ra_id', $raId)->get();
                    if ($planformativora->isEmpty()) {
                        $nestedTable->addCell(24, ['valign' => 'center', 'alignment' => Jc::CENTER])->addText('■', [], ['alignment' => 'center']);
                        $nestedTable->addCell(24, ['valign' => 'center', 'alignment' => Jc::CENTER])->addText('□', [], ['alignment' => 'center']);
                    } else {
                        $nestedTable->addCell(24, ['valign' => 'center', 'alignment' => Jc::CENTER])->addText('□', [], ['alignment' => 'center']);
                        $nestedTable->addCell(24, ['valign' => 'center', 'alignment' => Jc::CENTER])->addText('■', [], ['alignment' => 'center']);
                    }
                }
            }
        }
        $templateProcessor->setComplexBlock('table', $table);



        $table1 = new Table(array('cellMargin' => 0, 'borderSize' => 12, 'borderColor' => 'green', 'width' => 9700, 'unit' => TblWidth::TWIP, 'alignment' => JcTable::CENTER));
        $table1->addRow();

        $table1->addCell(2000, ['bgColor' => 'bfbfbf'])->addText('PLANIFICACIÓN DE LOS RESULTADOS DE APRENDIZAJE DE LA EMPRESA', $myFontStyle);
        $table1->addRow();
        $table1->addCell(130, ['bgColor' => 'd9d9d9'])->addText('MÓDULO PROFESIONAL', $myFontStyle);
        $table1->addCell(70, ['bgColor' => 'd9d9d9'])->addText('CÓDIGO', $myFontStyle);
        $table1->addCell(350, ['bgColor' => 'd9d9d9'])->addText('RESULTADOS DE APRENDIZAJE', $myFontStyle);
        $table1->addCell(70, ['bgColor' => 'd9d9d9'])->addText('CENTRO', $myFontStyle);
        $table1->addCell(70, ['bgColor' => 'd9d9d9'])->addText('EMPRESA', $myFontStyle);

        $modulos1 = Modulo::where('curso_id', $planformativo[0]->curso_id)->get();
        $planformativora2 = Plan_formativora::where('plan_formativo_id', $planformativo[0]->id)->pluck('modulo_id')->unique();
        //$modulos2 = Modulo::where('modulo_id',$planformativo[0]->modulo_id)->get();
        // $modulos3 = $planformativora2->groupby('modulo_id');
        // $modulos3 = $planformativora2->unique('modulo_id')
        // dd($planformativora2);
        //$modulos1 = Modulo::where('curso_id',$planformativo[0]->curso_id)->wherein($planformativora2->pluck('modulo_id')->toArray)->get();
        //dd($modulos1);
        $datos = $planformativo[0];

        foreach ($planformativora2 as $dato) {
            // dd((Modulo::where('id',$dato->modulo_id)->pluck('nombre'))[0]);
            //dd($dato);
            $table1->addRow();
            $table1->addCell(130, ['valign' => 'center'])->addText((Modulo::where('id', $dato)->pluck('nombre'))[0], ['bold' => true]);
            $table1->addCell(70, ['valign' => 'center'])->addText((Modulo::where('id', $dato)->pluck('codigo'))[0], ['bold' => true]);
            $planra = Plan_formativora::where('plan_formativo_id', $planformativo[0]->id)->where('modulo_id', $dato)->pluck('ra_id');
            // dd($planra);
            // $ratablas1 = Ra::where('modulo_id',$dato)->get();
            $cell1 = $table1->addCell(150);
            $nestedTable1 = $cell1->addTable(array('cellMargin' => 0, 'borderSize' => 0, 'spacing' => 0, 'borderColor' => 'green', 'unit' => TblWidth::TWIP, 'alignment' => JcTable::CENTER));
            // $nestedTable1 = $cell1->addTable(array('cellMargin' => 0));
            //  $textRun = $cell->addTextRun();
            foreach ($planra as $dato) {
                $nestedTable1 = $cell1->addTable(array('cellMargin' => 0, 'borderSize' => 0, 'spacing' => 0, 'borderColor' => 'green', 'unit' => TblWidth::TWIP, 'alignment' => JcTable::CENTER));

                // $nestedTable1 = $cell1->addTable(array('cellMargin' => 0, 'borderSize' => 0, 'spacing' => 0, 'borderColor' => 'green', 'unit' => TblWidth::TWIP));
                $nestedTable1->addRow();
                $nestedTable1->addCell(20)->addText(Ra::where('id', $dato)->pluck('nombre')[0], ['valign' => 'top', 'bold' => true]);
                $nestedTable1->addCell(100)->addText(Ra::where('id', $dato)->pluck('descripcion')[0], ['valign' => 'top', 'size' => 6]);
                //$planformativoId1 = $planformativo[0]->id;
                //$raId1 = $dato->id;
                $nestedTable1->addCell(24, ['valign' => 'center'])->addText('■', [], ['alignment' => 'center']);
                $nestedTable1->addCell(24, ['valign' => 'center'])->addText('□', [], ['alignment' => 'center']);
            }
        }
        $templateProcessor->setComplexBlock('table1', $table1);




        $templateProcessor->saveAs(storage_path('planformativo.docx'));

        return response()->download(storage_path('planformativo.docx'));
    }

    public function Relacion($record){
        $planformativo = Plan_formativo::where('id', $record)->get();
        $acuerdo = Acuerdo::where('empresa_id',$planformativo[0]->empresa_id)->pluck('acuerdo_numero');
        //dd($acuerdo[0]);

        $fileName = "relacion.docx";
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/template/' . $fileName));

        $templateProcessor->setValue('acuerdo', $acuerdo[0]);
        $templateProcessor->setValue('nombre_centro_educativo', $planformativo[0]->centro_educativo->nombre);
        $templateProcessor->setValue('nombre_empresa', $planformativo[0]->empresa->nombre);
        $templateProcessor->setValue('calle_empresa', $planformativo[0]->empresa->calle);
        $templateProcessor->setValue('localidad_empresa', $planformativo[0]->empresa->localidad);
        $templateProcessor->setValue('provincia_empresa', $planformativo[0]->empresa->provincia);
        $templateProcessor->setValue('nombre_ciclo_formativo', $planformativo[0]->curso->ciclo_formativo->nombre);
        $templateProcessor->setValue('codigo_ciclo_formativo', $planformativo[0]->curso->ciclo_formativo->codigo);
        $templateProcessor->setValue('año_academico', $planformativo[0]->año_academico);

        $table = new Table(array('cellMargin' => 0, 'borderSize' => 12, 'borderColor' => 'green','width' => 10500, 'unit' => TblWidth::TWIP, 'alignment' => JcTable::CENTER));
        $table->addRow();
        $myFontStyle = array('name' => 'Calibri bold', 'size' => 10, 'bold' => true, 'valign' => 'center');
        $table->addCell(230, ['bgColor' => 'd9d9d9'])->addText('', $myFontStyle);
        $table->addCell(70, ['bgColor' => 'd9d9d9'])->addText('', $myFontStyle);
        $table->addCell(70, ['bgColor' => 'd9d9d9'])->addText('', $myFontStyle);
        $table->addCell(170, ['bgColor' => 'd9d9d9'])->addText('PERIODO DE REALIZACION', $myFontStyle, ['alignment' => 'center']);

        $table->addRow();
        $table->addCell(230, ['bgColor' => 'd9d9d9'])->addText('APELLIDOS Y NOMBRE', $myFontStyle, ['alignment' => 'center']);
        $table->addCell(70, ['bgColor' => 'd9d9d9'])->addText('N.I.F.', $myFontStyle, ['alignment' => 'center']);
        $table->addCell(70, ['bgColor' => 'd9d9d9'])->addText('N.º HORAS', $myFontStyle, ['alignment' => 'center']);
        $table->addCell(85, ['bgColor' => 'd9d9d9'])->addText('FECHA INICIO', $myFontStyle, ['alignment' => 'center']);
        $table->addCell(85, ['bgColor' => 'd9d9d9'])->addText('FECHA FIN', $myFontStyle, ['alignment' => 'center']);
        $table->addRow();
        $table->addCell(230)->addText($planformativo[0]->alumno->nombre . ' '.$planformativo[0]->alumno->apellidos , [], ['alignment' => 'center']);
        $table->addCell(70)->addText($planformativo[0]->alumno->nif, [], ['alignment' => 'center']);
        $table->addCell(70)->addText($planformativo[0]->numero_horas, [], ['alignment' => 'center']);
        $table->addCell(85)->addText($planformativo[0]->fecha_inicio, [], ['alignment' => 'center']);
        $table->addCell(85)->addText($planformativo[0]->fecha_fin, [], ['alignment' => 'center']);
        $alumnos = $planformativo[0]->count('alumno_id');
        $templateProcessor->setValue('n_personas', $alumnos);
        $templateProcessor->setValue('nombre_primero', $planformativo[0]->alumno->nombre);
        $templateProcessor->setValue('apellidos_primero', $planformativo[0]->alumno->apellidos);
        $templateProcessor->setValue('nombre_ultimo', $planformativo[0]->alumno->nombre);
        $templateProcessor->setValue('apellidos_ultimo', $planformativo[0]->alumno->apellidos);

        //dd($alumnos);
       /* foreach ($alumnos as $dato) {
            $table->addRow();
            $table->addCell(230, ['bgColor' => 'd9d9d9'])->addText($dato->nombre);
            $table->addCell(70, ['bgColor' => 'd9d9d9'])->addText('N.I.F.', $myFontStyle);
            $table->addCell(70, ['bgColor' => 'd9d9d9'])->addText('N.º HORAS', $myFontStyle);
            $table->addCell(85, ['bgColor' => 'd9d9d9'])->addText('FECHA INICIO', $myFontStyle);
            $table->addCell(85, ['bgColor' => 'd9d9d9'])->addText('FECHA FIN', $myFontStyle);
        }*/

        $templateProcessor->setComplexBlock('table', $table);





        $templateProcessor->setValue('nombre_director', $planformativo[0]->centro_educativo->nombre_director);
        $templateProcessor->setValue('apellidos_director', $planformativo[0]->centro_educativo->apellidos_director);
        $templateProcessor->setValue('nombre_tutor_empresa', $planformativo[0]->empresa->nombre_tutor);
        $templateProcessor->setValue('apellidos_tutor_empresa', $planformativo[0]->empresa->apellidos_tutor);




        Carbon::setLocale('es');
        $fecha = Carbon::parse($planformativo[0]->fecha_firma);
        $date = $fecha->locale(); //con esto revise que el lenguaje fuera es
        //dd($fecha->monthName); //y con esta obtengo el mes al fin en español!
        $mfecha = $fecha->monthName;
        $dfecha = $fecha->day;
        $afecha = $fecha->year;

        $templateProcessor->setValue('fecha_firma_dia', $dfecha);
        $templateProcessor->setValue('fecha_firma_mes', $mfecha);
        $templateProcessor->setValue('fecha_firma_año', $afecha);


        $templateProcessor->saveAs(storage_path('relacion.docx'));

        return response()->download(storage_path('relacion.docx'));
    }
}
