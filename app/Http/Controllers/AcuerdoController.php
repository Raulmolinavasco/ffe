<?php

namespace App\Http\Controllers;

use App\Models\Acuerdo;
use App\Models\Centro_educativo as ModelsCentro_educativo;
use App\Models\Centro_educativo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Throwable;

class AcuerdoController extends Controller
{
    public function Acuerdo($record)
    {

        $acuerdo = Acuerdo::where('id',$record)->get();
        Carbon::setLocale('es');
        $fecha = Carbon::parse($acuerdo[0]->acuerdo_fecha);
        $date = $fecha->locale(); //con esto revise que el lenguaje fuera es
        //dd($fecha->monthName); //y con esta obtengo el mes al fin en español!
        $mfecha = $fecha->monthName;
        $dfecha = $fecha->day;
        $afecha = $fecha->year;
       /* $fecha = $acuerdo[0]->acuerdo_fecha;
        $mfecha = $fecha->format('m');
        $dfecha = $fecha->format('d');
        $afecha = $fecha->format('Y');
        */
        //dd($mes);
        //dd($carbon->subYear());
        //dd($acuerdo[0]->centro_educativo_id);
        //dd($acuerdo[0]->empresa->nombre);
        $centro_educativo = Centro_educativo::where('id',$acuerdo[0]->centro_educativo_id)->get();
        //dd($centro_educativo[0]->codigo_postal);
        $fileName = "acuerdo.docx";
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/template/' . $fileName));

        $templateProcessor->setValue('acuerdo_numero', $acuerdo[0]->acuerdo_numero);
        $templateProcessor->setValue('nombre_director', $centro_educativo[0]->nombre_director);
        $templateProcessor->setValue('apellidos_director', $centro_educativo[0]->apellidos_director);
        $templateProcessor->setValue('nif_director', $centro_educativo[0]->nif_director);
        $templateProcessor->setValue('centro_educativo', $centro_educativo[0]->centro_educativo);
        $templateProcessor->setValue('nif', $centro_educativo[0]->nif);
        $templateProcessor->setValue('codigo_centro', $centro_educativo[0]->codigo_centro);
        $templateProcessor->setValue('localidad', $centro_educativo[0]->localidad);
        $templateProcessor->setValue('provincia', $centro_educativo[0]->provincia);
        $templateProcessor->setValue('calle', $centro_educativo[0]->calle);
        $templateProcessor->setValue('codigo_postal', $centro_educativo[0]->codigo_postal);
        $templateProcessor->setValue('telefono', $centro_educativo[0]->telefono);
        $templateProcessor->setValue('email', $centro_educativo[0]->email);

        $templateProcessor->setValue('nombre_tutor', $acuerdo[0]->empresa->nombre_tutor);
        $templateProcessor->setValue('apellidos_tutor', $acuerdo[0]->empresa->apellidos_tutor);
        $templateProcessor->setValue('nif_tutor', $acuerdo[0]->empresa->nif_tutor);
        $templateProcessor->setValue('nombre_empresa', $acuerdo[0]->empresa->nombre);
        $templateProcessor->setValue('localidad_empresa', $acuerdo[0]->empresa->localidad);
        $templateProcessor->setValue('provincia_empresa', $acuerdo[0]->empresa->provincia);
        $templateProcessor->setValue('calle_empresa', $acuerdo[0]->empresa->calle);
        $templateProcessor->setValue('codigo_postal_empresa', $acuerdo[0]->empresa->codigo);
        $templateProcessor->setValue('nif_empresa', $acuerdo[0]->empresa->nif);
        $templateProcessor->setValue('telefono_empresa', $acuerdo[0]->empresa->telefono);
        $templateProcessor->setValue('email_empresa', $acuerdo[0]->empresa->email);

        $templateProcessor->setValue('dia', $dfecha);
        $templateProcessor->setValue('mes', $mfecha);
        $templateProcessor->setValue('año', $afecha);

        if($acuerdo[0]->seguridad_social == 'Empresa'){
        $templateProcessor->setValue('ssjcyl', '□');
        $templateProcessor->setValue('ssempresa', '■');
        }
        else{
            $templateProcessor->setValue('ssempresa', '□');
            $templateProcessor->setValue('ssjcyl', '■');
        }

        $templateProcessor->saveAs(storage_path('acuerdo.docx'));

        return response()->download(storage_path('acuerdo.docx'));

        /*$phpWord = new \PhpOffice\PhpWord\PhpWord();



        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/template/' . $fileName));

        $section = $phpWord->addSection();



        $description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";



        $section->addImage("images/favicon.png");

        $section->addText($description);



        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        try {

            $objWriter->save(storage_path('Programacion.docx'));

        } catch (Throwable  $e) {

        }

        return response()->download(storage_path('Programacion.docx'));

    }*/
    }
}
