<?php

namespace App\Http\Controllers\Panel;

use App\Paciente;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Direccion;

class DireccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $paciente = Paciente::find($id);
        $direcciones = $paciente->direcciones('id_paciente')->orderBy('activo', 'desc')->get();

        return view('panel.direcciones.index', compact('paciente', 'direcciones'));
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
    public function store(Request $request, $id_p)
    {
        //Guarda una nueva dirección
        $direccion = new Direccion();
        //dd($request);
        $direccion->calle = $request->get('calle');
        $direccion->altura = $request->get('altura');
        $direccion->piso = $request->get('piso');
        $direccion->departamento = $request->get('departamento');
        $direccion->codigo_postal = $request->get('codigo_postal');
        $direccion->localidad = $request->get('localidad');
        $direccion->provincia = $request->get('provincia');
        $direccion->pais = $request->get('pais');
        $direccion->activo = $request->has('activo') ? 2 : 1;
        $direccion->id_paciente = $id_p;

        $direccion->save();

        //$paciente = Paciente::find($id_p);
        //$direcciones = $paciente->direcciones('id_paciente')->orderBy('activo', 'desc')->get();

        return redirect()->action('Panel\DireccionesController@index', $id_p)->with('status', 'Dirección agregada correctamente.');
        //return view('panel.direcciones.index', compact('paciente', 'direcciones'))->with('status', 'Dirección agregada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForDelete($id_p, $id_d)
    {
        //Muestra datos para confirmar borrado
        $paciente = Paciente::find($id_p);
        $direccion = Direccion::find($id_d);

        return view('panel.direcciones.delete', compact('paciente', 'direccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_p, $id_d)
    {
        //
        $paciente = Paciente::find($id_p);
        $direccion = Direccion::find($id_d);

        return view('panel.direcciones.edit', compact('paciente', 'direccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_p, $id_d)
    {
        //Actualiza una dirección
        //$paciente = Paciente::find($id_p);
        $direccion = Direccion::find($id_d);

        $direccion->calle = $request->get('calle');
        $direccion->altura = $request->get('altura');
        $direccion->piso = $request->get('piso');
        $direccion->departamento = $request->get('departamento');
        $direccion->codigo_postal = $request->get('codigo_postal');
        $direccion->localidad = $request->get('localidad');
        $direccion->provincia = $request->get('provincia');
        $direccion->pais = $request->get('pais');
        $direccion->activo = $request->has('activo') ? 2 : 1;

        $direccion->save();

        //$direcciones = $paciente->direcciones('id_paciente')->orderBy('activo', 'desc')->get();

        return redirect()->action('Panel\DireccionesController@index', $id_p)->with('status', 'Dirección actualizada correctamente.');
        //return view('panel.direcciones.index', compact('paciente', 'direcciones'))->with('status', 'Dirección actualizada correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_p, $id_d)
    {
        //Borra dirección
        //$paciente = Paciente::find($id_p);
        $direccion = Direccion::find($id_d);
        $direccion->delete();

        //$direcciones = $paciente->direcciones('id_paciente')->orderBy('activo', 'desc')->get();

        return redirect()->action('Panel\DireccionesController@index', $id_p)->with('status', 'Dirección eliminada correctamente.');
        //return view('panel.direcciones.index', compact('paciente', 'direcciones'))->with('status', 'Dirección eliminada correctamente.');
    }
}
