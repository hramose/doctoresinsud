<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CampoBase;
use App\Consulta;
use App\ConsultaPatologia;
use App\ConsultaSintoma;
use App\Epidemiologia;
use App\Estudio;
use App\EstudioPaciente;
use App\EstudioPacienteValor;
use App\HistorialCampo;
use App\ImagenEstudio;
use App\Medicamento;
use App\Paciente;
use App\Patologia;
use App\Permission;
use App\Sintoma;
use App\TipoDato;
use App\Tratamiento;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ImportControler extends Controller
{
    public function epidiImport()
    {
        $epi = DB::select('select * from serio_import');
        $count = 0;
        foreach ($epi as $import){
            $pac = new Paciente();
            $pac =  $pac->getPacienteByHistoryClinic($import->HISTCLI);
            $count++;
            
            if(count($pac) == 1 && $import->FECHA != "SE" ){
                $serio = new EstudioPaciente();
                $serio->id_hc = $pac[0]->id;
                dump($count);
                
                if($import->FECHA != '.' && $import->FECHA != ''){
                    $serio->fecha = $import->FECHA;           
                }else{
                    $serio->fecha = "0/0/0000";
                }
                
                $serio->titulo = $import->ESTUDIO;
                $serio->descripcion = $import->CODIGO;
                $serio->id_estudio = 4;
                $serio->save();

                $values0 = new EstudioPacienteValor();
                $values0->estudios_pacientes_id = $serio->id;
                $values0->campos_base_id = 105;
                $values0->valor = $import->EVOLSERO;
                $values0->obs = "Sin Observacion";
                $values0->save();

                $values1 = new EstudioPacienteValor();
                $values1->estudios_pacientes_id = $serio->id;
                $values1->campos_base_id = 81;
                $values1->valor = $import->ELISA;
                $values1->obs = "Sin Observacion";
                $values1->save();

                $values2 = new EstudioPacienteValor();
                $values2->estudios_pacientes_id = $serio->id;
                $values2->campos_base_id = 82;
                $values2->valor = $import->ELISATITU;
                $values2->obs = "Sin Observacion";
                $values2->save();

                $values3 = new EstudioPacienteValor();
                $values3->estudios_pacientes_id = $serio->id;
                $values3->campos_base_id = 83;
                $values3->valor = $import->HAI;
                $values3->obs = "Sin Observacion";
                $values3->save();

                $values4 = new EstudioPacienteValor();
                $values4->estudios_pacientes_id = $serio->id;
                $values4->campos_base_id = 84;
                $values4->valor = $import->HAITITU;
                $values4->obs = "Sin Observacion";
                $values4->save();

                $values5 = new EstudioPacienteValor();
                $values5->estudios_pacientes_id = $serio->id;
                $values5->campos_base_id = 85;
                $values5->valor = $import->TIF;
                $values5->obs = "Sin Observacion";
                $values5->save();

                $values6 = new EstudioPacienteValor();
                $values6->estudios_pacientes_id = $serio->id;
                $values6->campos_base_id = 86;
                $values6->valor = $import->TIFTITU;
                $values6->obs = "Sin Observacion";
                $values6->save();

                $values7 = new EstudioPacienteValor();
                $values7->estudios_pacientes_id = $serio->id;
                $values7->campos_base_id = 87;
                $values7->valor = $import->MG;
                $values7->obs = "Sin Observacion";
                $values7->save();

                $values8 = new EstudioPacienteValor();
                $values8->estudios_pacientes_id = $serio->id;
                $values8->campos_base_id = 89;
                $values8->valor = $import->ADTITU;
                $values8->obs = "Sin Observacion";
                $values8->save();

                $values9 = new EstudioPacienteValor();
                $values9->estudios_pacientes_id = $serio->id;
                $values9->campos_base_id = 88;
                $values9->valor = $import->AD;
                $values9->obs = "Sin Observacion";
                $values9->save();
                //==================================================================
                $serio1 = new EstudioPaciente();
                $serio1->id_hc = $pac[0]->id;
                
                //AAAA-MM-DD
                //[0]->DIA,[1]->MES,[2]->AÑO
               if($import->FECHA != '.' && $import->FECHA != ''){
                    $serio1->fecha = $import->FECHA;           
                }else{
                    $serio1->fecha = "0/0/0000";
                }
                $serio1->titulo = $import->ESTUDIO;
                $serio1->descripcion = $import->CODIGO;
                $serio1->id_estudio = 3;
                $serio1->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 91;
                $valued0->valor = $import->GB;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 92;
                $valued0->valor = $import->HB;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 93;
                $valued0->valor = $import->GLUCEMIA;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 94;
                $valued0->valor = $import->UREMIA;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 95;
                $valued0->valor = $import->CREATININA;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 96;
                $valued0->valor = $import->ACURICO;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 97;
                $valued0->valor = $import->COLESTEROL;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 98;
                $valued0->valor = $import->HDL;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 99;
                $valued0->valor = $import->LDL;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 100;
                $valued0->valor = $import->TGL;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 101;
                $valued0->valor = $import->GOT;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 102;
                $valued0->valor = $import->GPT;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 103;
                $valued0->valor = $import->ORINA;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 104;
                $valued0->valor = $import->ORINAOBSER;
                $valued0->obs = "Sin Observacion";
                $valued0->save();

                $valued0 = new EstudioPacienteValor();
                $valued0->estudios_pacientes_id = $serio->id;
                $valued0->campos_base_id = 109;
                $valued0->valor = "0";
                $valued0->obs = "Sin valor registrado";
                $valued0->save();
                dump("Guardado");
               
            }
           
        }
        //dump($epi);
    }
    public function paciImport()
    {
        
    }
    public function pegiImport()
    {
        
    }
    public function tratImport()
    {
        
    }
}
