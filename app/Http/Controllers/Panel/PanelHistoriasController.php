<?php

namespace App\Http\Controllers\Panel;

use App\EstudioPaciente;
use App\EstudioPacienteValor;
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
     * @param $id_p
     * @return \Illuminate\Http\Response
     */


    public function verTodosTratamientos($id_p)
    {
        $paciente = Paciente::find($id_p);
        $tratamientos = $paciente->tratamientos('id_paciente')->orderBy('fecha_trat', 'desc')->get();

        return view('panel.tratamientos.showall', compact('tratamientos', 'paciente'));
    }

    /**
     * @param $id_p
     * @return \Illuminate\Http\Response
     */


    public function verTodosEstudios($id_p)
    {
        $estudios = DB::table('estudios_pacientes')
            ->join('estudios','estudios_pacientes.id_estudio', '=', 'estudios.id')
            ->where('estudios_pacientes.id_hc', '=', $id_p)
            ->select('estudios_pacientes.*', 'estudios.nombre')
            ->orderBy('estudios_pacientes.fecha', 'desc')
            ->get();

        return view('panel.estudios.showall', compact('estudios'));
    }


    /**
     * @return mixed
     */

    public function verEstudio($id_p, $id_e)
    {
        //$estudioPaciente = EstudioPaciente::find($id_e)->with('valores')->get();
        $estudioPaciente = EstudioPaciente::with('valores.campoBase.UnidadMedida', 'estudio')->find($id_e);
        $paciente = DB::table('pacientes')->select('id', 'id_hc', 'apellido', 'nombre')->where('id', $id_p)->get();
        //dd($estudioPaciente);
        //dd($estudioPaciente->valores);
        //dd($paciente);

        return view('panel.estudios.show', compact('paciente', 'estudioPaciente'));
    }

    /**
     * @return mixed
     */

    public function verTratamiento($id_p, $id_t)
    {
        //TODO: Desarrollar función para ver un tratamiento.
        $paciente = DB::table('pacientes')->select('id', 'id_hc', 'apellido', 'nombre')->where('id', $id_p)->get();
        $tratamiento = Tratamiento::find($id_t);

        //dd($tratamiento);

        return view('panel.tratamientos.show', compact('paciente', 'tratamiento'));
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
