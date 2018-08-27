<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//REQUEST
use App\Http\Requests;
use App\Http\Controllers\Controller;
//MODELS
use App\Paciente;
use App\Estudio;
use App\EstudioPaciente;
use App\EstudioPacienteValor;
use App\Tratamiento;
use App\Epidemiologia;
//HELPERS
use Excel;
use DB;
class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.importador.index');
    } 
    
    public function proccess(Request $request)
    {
        if($request->type == 0){
            $this->proccessPeg($request->file);
        }elseif($request->type == 1){
            $this->proccessEco($request->file);
        }elseif($request->type == 2){
            $this->proccessLab($request->file);
        }elseif($request->type == 3){
            $this->proccessTrat($request->file);
        }elseif($request->type == 4){
            $this->proccessEpidiom($request->file);
        }elseif($request->type == 5){
            $this->proccessPacient($request->file);
        }
        
    }
    //
    //  PROCESADOR DE ERGOMETRIA
    //
    public function proccessPeg($excelFile)
    {
        Excel::load($excelFile, function($reader){            
            $results = $reader->get();
            
            foreach ($results as $result) {
                $paciente = new Paciente();
                
                $paciente = $paciente->getPacienteByHistoryClinic($result->histcli);
                if(isset($paciente[0])){
                    $estudio = new EstudioPaciente();
                    
                    if($estudio->verifExist($result->fecha, $paciente[0]->id, 2)){
                        $estudio->id_hc = $paciente[0]->id;
                        $estudio->id_estudio =  2;
                      
                        $estudio->fecha = $result->fecha;
                        if($result->nropeg != null){
                            $estudio->titulo = $result->nropeg;
                        }else{
                            $estudio->titulo = '';
                        }
                        if( $estudio->fecha == null){
                            $estudio->descripcion = "Fecha no cargada";
                        }
                        $estudio->save();
                        
                        $data = $result->except(['histcli', 'apellido', 'nombre', 'fecha', 'nropeg']);
                        $counter = 31;
                        foreach ($data as $key => $lineValue) {
                            if ($counter <= 77){
                                $valores = new EstudioPacienteValor();
                                if($lineValue != '0' && $lineValue != null){
                                    $valores->valor = $lineValue;
                                }else{
                                     $valores->valor = 'NULL';
                                }
                                $valores->estudios_pacientes_id = $estudio->id;
                                $valores->campos_base_id = $counter;
                                $valores->save();
                            }
                            $counter++;
                        }
                    } 
                }else{
                    $error[] = $result->histcli;
                    
                }
            }
            dump($error);
        });
    }
    //  
    //  PROCESADOR DE EXCEL DE ECOCARDIOGRAMA
    //  
    public function proccessEco($excelFile)
    {
        Excel::load($excelFile, function($reader){
            $results = $reader->get();
           
            foreach ($results as $result) {
                $paciente = new Paciente();
                $paciente = $paciente->getPacienteByHistoryClinic($result->histcli);
                if(isset($paciente[0])){
                    $estudio = new EstudioPaciente();
                    if($estudio->verifExist($result->fecha, $paciente[0]->id, 1)){
                        $estudio->id_hc = $paciente[0]->id;
                        $estudio->id_estudio =  1;
                        $estudio->fecha = $result->fecha;
                        if($result->nropeg != null){
                            $estudio->titulo = $result->nropeg;
                        }else{
                            $estudio->titulo = 'ECO';
                        }
                        if($result->ecoobserv != null){
                            $estudio->descripcion = $result->ecoobserv;
                            if($result->fecha == null){
                               $estudio->descripcion .= " (Fecha no cargada)"; 
                            }
                        }elseif($result->fecha == null){
                            $estudio->descripcion = "Fecha no cargada";
                        }
                        
                        $estudio->save();
                        $data = $result->except(['histcli', 'apellido', 'nombre', 'fecha', 'ecoobserv']);
                        $counter = 1;
                        foreach ($data as $key => $lineValue) {
                            if ($counter <= 30){
                                $valores = new EstudioPacienteValor();
                                if($lineValue != '0' && $lineValue != null){
                                    $valores->valor = $lineValue;
                                }else{
                                     $valores->valor = 'NULL';
                                }
                                $valores->estudios_pacientes_id = $estudio->id;
                                $valores->campos_base_id = $counter;
                                $valores->save();
                            }
                            $counter++;
                        }
                    } 
                }else{
                    $error[] = $result->histcli;
                    
                }
            }
            dump($error);
        });
    }
    //
    //  PROCESADOR DE LABORATORIO SERIOLOGICO Y LABORATORIO CLINICO
    //
    public function proccessLab($excelFile)
    {
        Excel::load($excelFile, function($reader){
            $results = $reader->get();
            
            foreach ($results as $result){
                if($result->codigo == 'SE'){
                    $paciente = new Paciente();
                    $paciente = $paciente->getPacienteByHistoryClinic($result->histcli);
                    if(isset($paciente[0])){
                        $estudio = new EstudioPaciente();
                        if($estudio->verifExist($result->fecha, $paciente[0]->id, 4)){
                            $estudio->id_hc = $paciente[0]->id;
                            $estudio->id_estudio =  4;
                            $estudio->fecha = $result->fecha;
                            if($result->fecha == null){
                                $estudio->descripcion = "Fecha no cargada";
                            }
                            $estudio->save();
                            $data = $result->except(['histcli',
                            'apellido', 'nombre', 'fecha', 
                            'codigo', 'hto',
                            'gb', 'hb', 'glucemia',
                            'uremia', 'creatinina', 'acurico', 'colesterol', 'hdl',
                            'ldl', 'tgl', 'got', 'gpt', 'orina', 'orinaobser']);
                            
                            foreach($data as $key => $lineValue){
                                $valores = new EstudioPacienteValor();
                                if($key == "evolsero"){
                                    $valores->campos_base_id = 105;
                                }elseif($key == "estudio"){
                                    $valores->campos_base_id = 80;                  
                                }elseif($key == "elisa"){
                                    $valores->campos_base_id = 81;                  
                                }elseif($key == "elisatitu"){
                                    $valores->campos_base_id = 82;                  
                                }elseif($key == "hai"){
                                    dump($lineValue);
                                    $valores->campos_base_id = 83;                  
                                }elseif($key == "haititu"){
                                    $valores->campos_base_id = 84;                  
                                }elseif($key == "tif"){
                                    $valores->campos_base_id = 85;                  
                                }elseif($key == "tiftitu"){
                                    $valores->campos_base_id = 86;                  
                                }elseif($key == "mg"){
                                    $valores->campos_base_id = 87;                  
                                }elseif($key == "ad"){
                                    $valores->campos_base_id = 88;                  
                                }elseif($key == "adtitu"){
                                    $valores->campos_base_id = 89;                  
                                }
                                if($lineValue != '0' && $lineValue != null){
                                    $valores->valor = $lineValue;
                                }else{
                                     $valores->valor = 'NULL';
                                }
                                $valores->estudios_pacientes_id = $estudio->id;
                                $valores->save();
                            }
                        }
                    }else{
                        $error[] = $result->histcli;
                    }
                }elseif($result->codigo == 'LA'){
                    $paciente = new Paciente();
                    $paciente = $paciente->getPacienteByHistoryClinic($result->histcli);
                    if(isset($paciente[0])){
                        $estudio = new EstudioPaciente();
                        if($estudio->verifExist($result->fecha, $paciente[0]->id, 3)){
                            $estudio->id_hc = $paciente[0]->id;
                            $estudio->id_estudio =  3;
                            $estudio->fecha = $result->fecha;
                            if($result->fecha == null){
                                $estudio->descripcion = "Fecha no cargada";
                            }
                            $estudio->save();
                            $data = $result->except(['histcli',
                            'apellido', 'nombre', 'fecha', 
                            'codigo', 'estudio', 'evolsero',
                            'elisa', 'elisatitu', 'hai', 'haititu',
                            'tif', 'tiftitu', 'mg', 'ad', 'adtitu']);
                            
                            $counter = 90;
                            foreach ($data as $key => $lineValue) {
                                if ($counter <= 104){
                                    $valores = new EstudioPacienteValor();
                                    if($lineValue != '0' && $lineValue != null){
                                        $valores->valor = $lineValue;
                                    }else{
                                         $valores->valor = 'NULL';
                                    }
                                    $valores->estudios_pacientes_id = $estudio->id;
                                    $valores->campos_base_id = $counter;
                                    $valores->save();
                                }
                                $counter++;
                            }    
                        }
                    }else{
                        $error[] = $result->histcli;
                    }
                }else{
                    $errorNoData[] = $result->histcli;
                }
            }
            dump("HISTORIAS CLINICAS INEXISTENTES");
            dump($error);
            dump("DATOS NO COMPUTABLES");
            dump($errorNoData);
        });
    }
    //
    //  PROCESADOR DE TRATAMIENTOS
    //
    public function proccessTrat($excelFile)
    {
        Excel::load($excelFile, function($reader){
            $results = $reader->get();
            foreach($results as $result){
                $paciente = new Paciente();
                $paciente = $paciente->getPacienteByHistoryClinic($result->histcli);
                if(isset($paciente[0])){
                    $trat = new Tratamiento();
                    $verif = $trat->getTratamientoImporter($paciente[0]->id_hc, $result->fecha, $result->fliadroga);
                    if(!isset($verif[0])){
                        foreach ($result as $key => $value) {
                            if($value == null){
                                $result->$key = '.';
                            }
                        }
                        $trat->fecha_trat = $result->fecha;
                        $trat->droga = $result->droga;
                        $trat->dosis = $result->dosis;
                        $trat->flia_droga = $result->fliadroga;
                        $trat->obs_trat = $result->observacio;
                        $trat->id_paciente = $paciente[0]->id;

                        $trat->save();
                    }
                }else{
                    $errr[] = $result->histcli;
                }
            }
            $failed = array_unique($errr);
            dump($failed);
        });
    }
    //
    //  PROCESADOR DE EPIDIOMOLOGIA Y PACIENTES
    //
    public function proccessEpidiom($excelFile)
    {
        Excel::load($excelFile, function($reader){
            $results = $reader->get();
          
            foreach($results as $result){
               
               $paciente = new Paciente();
               $paciente = $paciente->getPacienteByHistoryClinic($result->histcli);
               if(!isset($paciente[0])){
                     $epim = DB::table('temp_epidio')->where('id_hc', $result->histcli)->get();
                     if(count($epim) == 0){
                        DB::table('temp_epidio')->insert([
                            [
                                'id_hc' => $result->histcli, 
                                'numero_doc' => $result->docnro, 
                                'type_doc' => $result->doctipo,
                                'sexo' => $result->sexo, 
                                'est_civil' => $result->estcivil
                            ]
                        ]);                   
                     }
                }else{
                    $verifEpidio = new Epidemiologia();
                    $verifEpidio = $verifEpidio->getPacienteById($paciente[0]->id);
                    if(count($verifEpidio) == 0){
                        $nEpidemio = new Epidemiologia();
                        $data = $result->except(['histcli', 'docnro', 'doctipo', 'estcivil']);
                        $dataProcces = array();
                        foreach ($data as $index => $lineValue) {
                            $dataProcces[$index] = $lineValue;
                        }
                        foreach ($dataProcces as $key => $val) {
                            if($val == NULL){
                                $dataProcces[$key] = '.';
                            }
                        }
                        $dataProcces['id_paciente'] = $paciente[0]->id;
                        
                        DB::table('epidemiologias')->insert([$dataProcces]);
                        
                    } 
                }
            }
        });
    }
    public function proccessPacient($excelFile)
    {
        Excel::load($excelFile, function($reader){
            $results = $reader->get();
            $error = '';
            foreach($results as $result){
               
               $paciente = new Paciente();
               $paciente = $paciente->getPacienteByHistoryClinic($result->histcli);
               $error  = array();
               if(!isset($paciente[0])){
                $error[] = $result->histcli;
                       $val = true;
                       
                        foreach($result as $key => $value){
                            if($value == null){
                                $result->$key = '';
                            }
                        }
                        $nPaciente = new Paciente();
                        $nPaciente->id_hc = $result->histcli;
                        
                        $nPaciente->tipo_doc =          $result->doctypo;
                        $nPaciente->numero_doc =        $result->dcnro;
                        $nPaciente->sexo =              $result->sexo;
                        $nPaciente->estado_civil =      $result->est_civil;
                        $nPaciente->sexo =              '?';
                        $nPaciente->estado_civil =      '?';
                        $nPaciente->apellido            = $result->apellido;
                        $nPaciente->nombre              = $result->nombre;
                        $nPaciente->fecha_nac           = $result->fechanac;
                        $nPaciente->citacion            = $result->citacion;
                        $nPaciente->proxima_cita        = $result->fecha_cita;
                        $nPaciente->fecha_alta          = $result->fechalta;
                        $nPaciente->serologia_ing       = $result->seroing;
                        $nPaciente->tres_negativas      = $result->tresneg;
                        $nPaciente->titulos_sero_ing    = $result->titsero;
                        $nPaciente->trat_etio           = $result->te;
                        $nPaciente->fecha_ini_trat_bnz  = $result->fechatebnz;
                        $nPaciente->trat_bnz            = $result->benz;
                        $nPaciente->efectos_adv_bnz     = $result->benzefadv;
                        $nPaciente->efec_rash_bnz       = $result->benzrash;
                        $nPaciente->efec_intgas_bnz     = $result->benzintgas;
                        $nPaciente->efec_afhep_bnz      = $result->benzafhep;
                        $nPaciente->efec_afneur_bnz     = $result->benzafneur;
                        $nPaciente->efec_afhem_bnz      = $result->benzafhem;
                        $nPaciente->susp_bnz            = $result->benzsusp;
                        $nPaciente->efec_otros_bnz      = $result->benzotros;
                        $nPaciente->trat_nifur          = $result->nifur;
                        $nPaciente->fecha_ini_trat_nifur= $result->fechatenif;
                        $nPaciente->efectos_adv_nifur   = $result->nifurefadv;
                        $nPaciente->efec_rash_nifur     = $result->nifrash;
                        $nPaciente->efec_intgas_nifur   = $result->nifintgas;
                        $nPaciente->efec_afhep_nifur    = $result->nifafhep;
                        $nPaciente->efec_afneur_nifur   = $result->nifafneur;
                        $nPaciente->efec_afhem_nifur    = $result->nifafhem;
                        $nPaciente->efec_otros_nifur    = $result->nifotros;
                        $nPaciente->susp_nifur          = $result->nifsusp;
                        $nPaciente->otros_trat          = $result->otroste;
                        $nPaciente->trat_etio_obs       = $result->observte;
                        $nPaciente->sin_patologia       = $result->sinpa;
                        $nPaciente->tuberculosis        = $result->tbc;
                        $nPaciente->epoc                = $result->epoc;
                        $nPaciente->dbt                 = $result->dbt;
                        $nPaciente->colageno            = $result->colageno;
                        $nPaciente->obesidad            = $result->obesidad;
                        $nPaciente->alcoholismo         = $result->alcohol;
                        $nPaciente->hipotiroidismo      = $result->hipotir;
                        $nPaciente->hipertiroidismo     = $result->hipertir;
                        $nPaciente->cardio_congenitas   = $result->cardcong;
                        $nPaciente->valvulopatias       = $result->valvular;
                        $nPaciente->cardio_isquemica    = $result->cardisq;
                        $nPaciente->ht_arterial_leve    = $result->htal;
                        $nPaciente->ht_arterial_mode    = $result->htam;
                        $nPaciente->ht_arterial_severa  = $result->htas;
                        $nPaciente->acv                 = $result->acv;
                        $nPaciente->otras_pat_asoc      = $result->otraspa;
                        $nPaciente->tension_art_bsist   = $result->tabsist;
                        $nPaciente->tension_art_bdiast  = $result->tabdiast;
                        $nPaciente->frec_cardi_basal    = $result->fcbasal;
                        $nPaciente->asintomatico        = $result->asintoma;
                        $nPaciente->palpitaciones       = $result->palpitacio;
                        $nPaciente->precordialgia_atipica = $result->precoratip;
                        $nPaciente->angor               = $result->angor;
                        $nPaciente->disnea              = $result->disnea;
                        $nPaciente->disnea1             = $result->disnea1;
                        $nPaciente->disnea2             = $result->disnea2;
                        $nPaciente->disnea3             = $result->disnea3;
                        $nPaciente->disnea4             = $result->disnea4;
                        $nPaciente->mareos              = $result->mareos;
                        $nPaciente->perdida_conoc       = $result->pc;
                        $nPaciente->insuf_cardiaca      = $result->ic;
                        $nPaciente->tipo_insuf_card     = $result->tipoic;
                        $nPaciente->otros_sintomas_ing  = $result->otrossin;
                        $nPaciente->nuevos_sintomas     = $result->nsi;
                        $nPaciente->obs_sintomas        = $result->observsi;
                        $nPaciente->ecg                 = $result->ecg;
                        $nPaciente->tipo_ecg            = $result->tipoecg;
                        $nPaciente->nuevos_cambios_ecg  = $result->nec;
                        $nPaciente->fecha_cambios_ecg   = $result->fechanec;
                        $nPaciente->tipo_cambio_ecg     = $result->tiponec;
                        $nPaciente->obs_ecg             = $result->observecg;
                        $nPaciente->fecha_rx_torax      = $result->fechart;
                        $nPaciente->rx_torax            = $result->rt;
                        $nPaciente->indice_cardiotorax  = $result->ict;
                        $nPaciente->obs_rxt             = $result->observrt;
                        $nPaciente->cambios_rxt         = $result->crt;
                        $nPaciente->fecha_cambios_rxt   = $result->fechacrt;
                        $nPaciente->nueva_rxt           = $result->nrt;
                        $nPaciente->grupo_clinico_ing   = $result->gcli;
                        $nPaciente->cambio_grupo_cli    = $result->cgcl;
                        $nPaciente->fecha_cambio_gcli   = $result->fechacgcl;
                        $nPaciente->nuevo_grupo_cli     = $result->ngcl;
                        $nPaciente->fecha_ult_consulta  = $result->fechultcon;
                        $nPaciente->vivo                = $result->vivo;
                        $nPaciente->causa_muerte        = $result->causamuer;
                        $nPaciente->trat_sintomat       = $result->ts;
                        $nPaciente->evolucion           = $result->evolucion;
                        
                        foreach($nPaciente as $key => $value){
                            if($value == null){
                                $nPaciente->$key = '';
                            }
                        }
                       
                        $nPaciente->save(); 

                   if(isset($epim[0])){
                                         }else{
                     $error .= $result->histcli . ',';
                   }
                 
               }elseif($paciente[0]->fecha_alta == null){
                    $paciente[0]->fecha_alta = $result->fechalta;
               }
            }
            dump($error);
        });
    }
}
