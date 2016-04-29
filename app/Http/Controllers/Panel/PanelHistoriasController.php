<?php

namespace App\Http\Controllers\Panel;

use App\Tratamiento;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paciente;
use Illuminate\Support\Facades\DB;

class PanelHistoriasController extends Controller
{

    public function getHCJson(){
        $pacientes = DB::table('pacientes')->select('id', 'id_hc', 'apellido', 'nombre', 'fecha_alta', 'fecha_ult_consulta')->get();

        $pacientes = json_decode(json_encode($pacientes), true);
        //var_dump($pacientes); die;
        return $pacientes;
    }
    /**
     * Funcion para ver historia clinica de un paciente.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */

    public function verHistoria($id)
    {
        $paciente = Paciente::find($id);
//        $paciente = Paciente::find($id)->with('tratamientos' => function($query){
//                $query->where('id_hc', '=', ),
//    });
        $tratamientos = $paciente->tratamientos('id_paciente')->orderBy('fecha_trat', 'desc')->take(10)->get();
       // $estudios = $paciente->estudioPacientes('id_hc')->orderBy('fecha', 'desc')->take(10)->get();
        $estudios = DB::table('estudios_pacientes')
                        ->join('estudios','estudios_pacientes.id_estudio', '=', 'estudios.id')
                        ->where('estudios_pacientes.id_hc', '=', $id)
                        ->select('estudios_pacientes.*', 'estudios.nombre')
                        ->orderBy('estudios_pacientes.fecha', 'desc')
                        ->take(10)
                        ->get();

        return view('panel.show', compact('paciente', 'tratamientos', 'estudios'));
    }

    /**
     * @return mixed
     */

    public function verEstudio($id)
    {
        //TODO: Desarrollar función para ver un estudio.
    }

    /**
     * @return mixed
     */

    public function verTratamiento($id)
    {
        //TODO: Desarrollar función para ver un tratamiento.
    }

    public function index()
    {
        //
        //$pacientes = Paciente::all();
        //$pacientes = collect(DB::table('pacientes')->select('id', 'id_hc', 'apellido', 'nombre', 'fecha_alta', 'fecha_ult_consulta')->get());

        //var_dump($pacientes); die;

        return view('panel.index'/*, compact('pacientes')*/);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
