<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Doctrine\DBAL\Schema\Column;
use App\Paciente; 
use Illuminate\Http\UploadedFile;
use Excel;
use App\Tratamiento;
use Carbon\Carbon;
use App\Estudio;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($errores = '')
    {
        //$tables = DB::select('SHOW TABLES');
        $tables = [];
        $counter = 0;
        $tables[$counter]['name'] ='pacientes';
        $tables[$counter]['fields'] = DB::getSchemaBuilder()->getColumnListing('pacientes');
        
        $estudios = Estudio::all();
        foreach ($estudios as $estudio) {
            $counter++;
            $tables[$counter]['name'] = $estudio->nombre;
            foreach ($estudio->camposBase as $key => $field) {
                $tables[$counter]['fields'][$field->id] = $field->descripcion;    
 
            }
        }
        $counter++;
        $drogas = Tratamiento::select('droga')->groupBy('droga')->get();
        $tables[$counter]['name'] = "Tratamiento";
        foreach ($drogas as $droga) {
            if($droga->droga != ''){
                $tables[$counter]['fields'][] = trim($droga->droga);
            }
        }
        $counter++;
        $tables[$counter]['name'] = "Epidemiologia";
        $tables[$counter]['fields'] = DB::getSchemaBuilder()->getColumnListing('epidemiologias');
        
        return view('reportes.reporte-ui', compact('tables', 'hide_tables', 'hide_fields', 'errores'));
    }
    public function reportIndividual()
    {
        Excel::create('Historias', function($excel) {
            $excel->sheet('Informe', function($sheet){
                $pacientes = Paciente::where('fecha_nac', '>', '1968-01-01')->where('fecha_nac', '<', '1998-12-31')->orderBy('fecha_nac', 'asc')->get();
                $data = [];
                foreach ($pacientes as $paciente) {
                /*
                    $droga = 'No';
                    $val = true;
                    $keyWord = '';
                    $tratamientes1 = Tratamiento::where('id_paciente', $paciente->id)->where('droga', 'like', '%ATOR%')->get();
                    if(count($tratamientes1)  > 0){
                        $keyWord = $tratamientes1[0]->droga;
                        $droga = 'Si';
                        $val = false;

                    }
                    $tratamientes2 = Tratamiento::where('id_paciente', $paciente->id)->where('droga', 'like', '%ROSU%')->get();
                    if(count($tratamientes2) > 0){
                        $keyWord = $tratamientes2[0]->droga;
                        $droga = 'Si';
                        $val = false;

                    }
                    $tratamientes3 = Tratamiento::where('id_paciente', $paciente->id)->where('droga', 'like', '%ESTATINAS%')->get();
                    if(count($tratamientes3) > 0){
                        $keyWord = $tratamientes3[0]->droga;
                        $droga = 'Si';
                        $val = false;

                    }
                    $tratamientes4 = Tratamiento::where('id_paciente', $paciente->id)->where('droga', 'like', '%ROSUVASTATINA%')->get();
                    if(count($tratamientes4) > 0){
                        $droga = 'Si';
                        $keyWord = $tratamientes4[0]->droga;
                        $val = false;
                    }
                    
                    if(true){
                        $evolution = explode(' ', $paciente->evolucion);
                        foreach ($evolution as $value) {
                            $value = trim($value);
                            $value = str_replace('\\', '', $value);
                            $value = str_replace("\r", '', $value);
                            $value = str_replace("\n", '', $value);
                            $value = str_replace('/', '', $value);
                            $value = str_replace(',', '', $value);
                            $value = str_replace('.', '', $value);
                            $value = str_replace('(', '', $value);
                            $value = str_replace(')', '', $value);
                            $value = str_replace('"', '', $value);
                            $value = str_replace("'", '', $value);
                            $value = str_replace(";", '', $value);
                            $value = str_replace("¿", '', $value);
                            $value = str_replace("?", '', $value);
                            $value = str_replace("!", '', $value);
                            $value = str_replace("¡", '', $value);
                            $value = str_replace("{", '', $value);
                            $value = str_replace("}", '', $value);
                            $value = str_replace("-", '', $value);
                            $value = str_replace(":", '', $value);
                            $value = str_replace("´", '', $value);
                            $value = str_replace("=", '', $value);
                            $value = str_replace("%", '', $value);
                            $value = str_replace("_", '', $value);
                            $value = str_replace("|", '', $value);
                            $value = str_replace("°", '', $value);
                            $value = str_replace("&", '', $value);
                            $value = str_replace("*", '', $value);

                            $keyWords = [
                                'ATORVA', 'ATORV', 'ATORVAS', 'ATORVASTATIN', 'ATORVASTATINA', 'ATORVASTATINE', 'ATOSVASTATIN', 'atorv',
                                'ESTATINAS', 'ESTATINA', 'ESTATINAS', 'ESVASTATINA', 'ROSU', 'ROSIMBASTATINA', 'ROSUV', 'ROSUVASTATINA',
                                'atorva', 'atorv', 'atorvas', 'atorvastatin', 'atorvastatina', 'atorvastatine', 'atosvastatin', 'atorv',
                                'estatinas', 'estatina', 'estatinas', 'esvastatina', 'rosu', 'rosimbastatina', 'rosuv', 'rosuvastatina',
                            ];
                            if(in_array(trim($value), $keyWords)){
                               
                                $droga = 'SI';
                                $keyWord = $value;
                            }           
                        }
                        
                    }
                */
                    $edadIn = Carbon::parse($paciente->fecha_nac);
                    $edad = 2018 - $edadIn->year;
                    $edadCC = Carbon::parse($paciente->fecha_cambio_gcli);
                    if($paciente->fecha_cambio_gcli != null){
                        $edadCC = $edadCC->year - $edadIn->year;
                    }else{
                        $edadCC = "";
                    }
                    $bnz = Carbon::parse($paciente->fecha_ini_trat_bnz);
                    if($paciente->fecha_ini_trat_bnz != null){
                        $bnz = $bnz->day  . '/' . $bnz->month .'/' . $bnz->year; 
                    }else{
                        $bnz = "";
                    }
                    $nifur = Carbon::parse($paciente->fecha_ini_trat_nifur);
                    if($paciente->fecha_ini_trat_nifur != null){
                        $nifur = $nifur->day  . '/' . $nifur->month .'/' . $nifur->year; 
                    }else{
                        $nifur = "";
                    }
                    $data[] = [
                        'Nombre'    => $paciente->nombre . ' ' . $paciente->apellido,
                        'Historia clinica'   => $paciente->id_hc,
                        'Edad' => $edad,
                        'Grupo clinico al ingreso' =>$paciente->grupo_clinico_ing, 
                        'Cambio de grupo de clinico' => $paciente->cambio_grupo_cli,
                        'Nuevo Grupo Clinico' => $paciente->nuevo_grupo_cli,
                        'Edad de cambio de grupo clinico' => $edadCC,
                        'NEC' => $paciente->nuevos_cambios_ecg,
                        'Tratamiento etiologioco' => $paciente->trat_etio,
                        'inicio tratamiento BNZ' => $bnz,
                        'inicio tratamiento NIFUR' => $nifur
                        //'ESTATINAS' => $droga,
                        //'keyWord' => ucwords(strtolower($keyWord))
                    ];
                    
                }
                $sheet->fromArray($data);
            });
        })->export('xlsx');
       
    }
    public function getReport(Request $request)
    {
        if($request->column && $request->filter){
            $val = false;
            $consult = [];
            $validPacientes = false;
            foreach ($request->column as $row) {
                if($row['table'] == 'pacientes'){
                    $consult[] = $row['column'];
                    $validPacientes = true;
                }
            }
            $filter = [];
            $validFilter = false;
            foreach ($request->filter as $key => $filterV) {
                if($filterV['table'] == 'pacientes'){
                    $filt  = $filterV['column'] . ' ' . $filterV['condition'] . "'" . str_replace('31', '12', $filterV['value']) . "'";
                    $filter[] = $filt;  
                }
            }
            if(count($filter) > 0) $validFilter = true;

            if($validPacientes && $validFilter){
                $pacientes =  Paciente::selectRaw(implode(',', $consult))->whereRaw(implode(' AND ', $filter))->get();
                Excel::create('Informe', function($excel) use ($pacientes) {
                    $excel->sheet('Informe', function($sheet) use ($pacientes){
                        $data = [];
                        $pacienteModel = new Paciente();
                        $pacientes = $pacientes->toArray();
                        $dates = $pacienteModel['dates'];
                        foreach ($pacientes as $index => $paciente) {
                            foreach ($paciente as $key => $row) {
                                if(in_array($key, $dates)){
                                    if($row != '0000-00-00' && $row != ''){
                                        $date = Carbon::parse($row);
                                        if($date != null){
                                            $date = $date->day  . '/' . $date->month .'/' . $date->year; 
                                        }else{
                                            $date = "";
                                        }
                                    }else{
                                        $date = '';
                                    }
                                    if($date == '30/11/-1'){
                                        $date = '';
                                    }
                                    $pacientes[$index][$key] = $date;                            
                                }
                                $pacientes[$index][strtoupper(str_replace('_', ' ', $key))] =  $pacientes[$index][$key];
                                unset($pacientes[$index][$key]);
                            }
                        }
                        $sheet->fromArray($pacientes);
                    });
                })->export('xlsx');
            }else{
                return redirect()->route('reportes', '1');
            }
        }else{
            return redirect()->route('reportes', '2');
        }
        
    }
}
