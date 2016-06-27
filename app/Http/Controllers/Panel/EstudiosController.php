<?php

namespace App\Http\Controllers\Panel;

use App\Estudio;
use App\EstudioPaciente;
use App\EstudioPacienteValor;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EstudiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/*    public function index()
    {
        //
    }*/

    public function getCamposByEstudio($id)
    {
        $estudio = Estudio::find($id);

        $campos = $estudio->camposBase()->with('UnidadMedida')->get();

        //dd($campos);
        //dd(json_encode($campos));
        return json_encode($campos);


    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_p)
    {
        //TODO: Muestra vista para dar de alta un nuevo estudio. Tiene en cuenta selección de estudio a realizar dinámicamente
        $paciente = Paciente::find($id_p);
        $estudios = Estudio::all();

        return view('panel.estudios.create2', compact('paciente','estudios')); //modificado por create2 para pruebas
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id_p, Request $request)
    {
        //TODO: Graba en la base de datos el estudio recién cargado
        //dd($request);
        $estudioPaciente = new EstudioPaciente();
        $estudioPaciente->id_hc = $id_p;//$request->get('id_hc');
        $estudioPaciente->fecha = $request->get('fecha');
        $estudioPaciente->id_estudio = $request->get('id_estudio');
        $estudioPaciente->titulo = $request->get('titulo');
        $estudioPaciente->descripcion = $request->get('estudio_desc');

        $estudioPaciente->save();

        foreach($request->get('campos') as $campo){
            $valor = new EstudioPacienteValor();
            $valor->campos_base_id = $campo['id_campo_base'];
            $valor->estudios_pacientes_id = $estudioPaciente->id;
            if(array_key_exists('valor', $campo)){
                $valor->valor = $campo['valor'];
            }
            $valor->obs = $campo['obs'];
            $valor->save();
        }

        return redirect()->action('Panel\PanelHistoriasController@verHistoria', $id_p)->with('status', 'Estudio cargado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForDelete($id_p, $id_e)
    {
        //TODO: Muestra una vista para confirmar la eliminación del estudio
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_p, $id_e)
    {
        //TODO: Muestra una vista para editar un estudio
        $estudioPaciente = EstudioPaciente::with('valores.campoBase.UnidadMedida', 'estudio')->find($id_e);
        $paciente = DB::table('pacientes')->select('id', 'id_hc', 'apellido', 'nombre')->where('id', $id_p)->get();

        return view('panel.estudios.edit', compact('paciente', 'estudioPaciente'));
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
        //TODO: Actualiza un estudio en la base de datos
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: Elimina un estudio de la base de datos
    }
}
