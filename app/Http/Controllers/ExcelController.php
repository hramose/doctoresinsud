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
//HELPERS
use Excel;
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
                    if($estudio->verifExist($paciente[0]->id, $result->fecha, 1 )){
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
                        if($estudio->verifExist($paciente[0]->id, $result->fecha, 4)){
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
                        if($estudio->verifExist($paciente[0]->id, $result->fecha, 3)){
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
            dump($reader->all());
        });
    }
    //
    //  PROCESADOR DE EPIDIOMOLOGIA Y PACIENTES
    //
    public function proccessEpidiom($excelFile)
    {
        Excel::load($excelFile, function($reader){
            dump($reader->all());
        });
    }        
    
}
