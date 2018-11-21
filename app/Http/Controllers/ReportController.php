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
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = DB::select('SHOW TABLES');

        $hide_tables = ['categories', 'comments', 'dbf_eco', 'dbf_epidemio',
            'dbf_ergometria', 'dbf_lab', 'dbf_pacientes', 'category_post',
            'dbf_tratamientos', 'posts', 'role_user', 'roles', 'migrations',
            'password_resets', 'permission_role', 'permissions', 'paciente_user',
            'users', 'telefonos', 'tickets', 'tipo_datos'];

        $hide_fields = ['created_at', 'updated_at', 'id'];

        return view('reportes.reporte-ui', compact('tables', 'hide_tables', 'hide_fields'));
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
                        'inicio tratamiento BNZ' => $paciente->fecha_ini_trat_bnz,
                        'inicio tratamiento NIFUR' => $paciente->fecha_ini_trat_nifur
                        //'ESTATINAS' => $droga,
                        //'keyWord' => ucwords(strtolower($keyWord))
                    ];
                    
                }
                $sheet->fromArray($data);
            });
        })->export('xlsx');
       
    }
}
