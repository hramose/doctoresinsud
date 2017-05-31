<?php

namespace App\Http\Controllers\Panel;

use App\Paciente;
use App\Telefono;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TelefonosController extends Controller
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
        $telefonos = $paciente->telefonos('id_paciente')->orderBy('activo', 'desc')->get();

        return view('panel.telefonos.index', compact('paciente', 'telefonos'));
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
    public function store(Requests\TelefonosFormRequest $request, $id_p)
    {
        //
        //Guarda una nuevo teléfono
        $telefono = new Telefono();
        //dd($request);
        $telefono->etiqueta = $request->get('etiqueta');
        $telefono->telefono = $request->get('telefono');
        $telefono->activo = $request->has('activo') ? 2 : 1;
        $telefono->id_paciente = $id_p;

        $telefono->save();

        return redirect()->action('Panel\TelefonosController@index', $id_p)->with('status', 'Teléfono agregado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForDelete($id_p, $id_t)
    {
        //
        //Muestra datos para confirmar borrado
        $paciente = Paciente::find($id_p);
        $telefono = Telefono::find($id_t);

        return view('panel.telefonos.delete', compact('paciente', 'telefono'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_p, $id_t)
    {
        //
        $paciente = Paciente::find($id_p);
        $telefono = Telefono::find($id_t);

        return view('panel.telefonos.edit', compact('paciente', 'telefono'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\TelefonosFormRequest $request, $id_p, $id_t)
    {
        //
        //Actualiza un teléfono
        $telefono = Telefono::find($id_t);

        $telefono->etiqueta = $request->get('etiqueta');
        $telefono->telefono = $request->get('telefono');
        $telefono->activo = $request->has('activo') ? 2 : 1;
        $telefono->id_paciente = $id_p;

        $telefono->save();
        
        return redirect()->action('Panel\TelefonosController@index', $id_p)->with('status', 'Teléfono actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_p, $id_t)
    {
        //Borra teléfono
        $telefono = Telefono::find($id_t);
        $telefono->delete();
        
        return redirect()->action('Panel\TelefonosController@index', $id_p)->with('status', 'Teléfono eliminado correctamente.');
    }
}
