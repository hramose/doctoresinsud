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
     * Retorna listado de objetos campos base asociado a un estudio
     *
     * return json
     */

    public function getCamposByEstudio($id)
    {
        //Envía por ajax los campos base a completar por el estudio solicitado

        $estudio = Estudio::find($id);

        $campos = $estudio->camposBase()->with('UnidadMedida')->get();

        return json_encode($campos);


    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_p)
    {
        //Muestra vista para dar de alta un nuevo estudio. Tiene en cuenta selección de estudio a realizar dinámicamente

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
        //Graba en la base de datos el estudio recién cargado

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
     * @param  int  $id_p, int $id_e
     * @return \Illuminate\Http\Response
     */
    public function showForDelete($id_p, $id_e)
    {
        //Muestra una vista para confirmar la eliminación del estudio

        $estudioPaciente = EstudioPaciente::with('valores.campoBase.UnidadMedida', 'estudio')->find($id_e);
        $paciente = DB::table('pacientes')->select('id', 'id_hc', 'apellido', 'nombre')->where('id', $id_p)->get();

        return view('panel.estudios.delete', compact('paciente', 'estudioPaciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_p, int $id_e
     * @return \Illuminate\Http\Response
     */
    public function edit($id_p, $id_e)
    {
        //Muestra una vista para editar un estudio

        $estudioPaciente = EstudioPaciente::with('valores.campoBase.UnidadMedida', 'estudio')->find($id_e);
        $paciente = DB::table('pacientes')->select('id', 'id_hc', 'apellido', 'nombre')->where('id', $id_p)->get();

        return view('panel.estudios.edit', compact('paciente', 'estudioPaciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Request $request, int $id_p, int $id_e
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_p, $id_e)
    {
        //Actualiza un estudio en la base de datos

        $estudioPaciente = EstudioPaciente::find($id_e);
        $estudioPaciente->fecha = $request->get('fecha');
        $estudioPaciente->titulo = $request->get('titulo');
        $estudioPaciente->descripcion = $request->get('estudio_desc');

        $estudioPaciente->save();

        foreach($request->get('campos') as $campo){
            $valor = EstudioPacienteValor::find($campo['id_valor']);
            if(array_key_exists('valor', $campo)){
                $valor->valor = $campo['valor'];
            }
            $valor->obs = $campo['obs'];
            $valor->save();
        }

        return redirect()->action('Panel\PanelHistoriasController@verHistoria', $id_p)->with('status', 'Estudio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id_p, int $id_e
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_p, $id_e)
    {
        //Elimina un estudio de la base de datos

        $estudioPaciente = EstudioPaciente::find($id_e);

        $estudioPaciente->delete();

        $valores = EstudioPacienteValor::where('estudios_pacientes_id', '=', $id_e)->get();

        foreach($valores as $valor){
            $valor->delete();
        }

        return redirect()->action('Panel\PanelHistoriasController@verHistoria', $id_p)->with('status', 'Estudio eliminado correctamente');
    }
}
