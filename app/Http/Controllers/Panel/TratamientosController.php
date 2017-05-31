<?php

namespace App\Http\Controllers\Panel;

use App\Paciente;
use App\Tratamiento;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TratamientoFormRequest;
use App\Http\Controllers\Controller;

class TratamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_p)
    {
        //Para crear un nuevo tratamiento, muestra la vista de creación
        $paciente = Paciente::find($id_p);

        return view('panel.tratamientos.create', compact('paciente'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TratamientoFormRequest $request, $id_p)
    {
        //Guarda el tratamiento recién cargado
        $tratamiento = new Tratamiento();
        $tratamiento->droga = $request->get('droga');
        $tratamiento->dosis = $request->get('dosis');
        $tratamiento->flia_droga = $request->get('flia_droga');
        $tratamiento->fecha_trat = $request->get('fecha_trat');
        $tratamiento->obs_trat = $request->get('obs_trat');
        $tratamiento->id_hc = $request->get('id_hc');
        $tratamiento->id_paciente = $id_p;

        $tratamiento->save();
        
        return redirect()->action('Panel\PanelHistoriasController@verHistoria', $id_p)->with('status', 'Tratamiento cargado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForDelete($id_p, $id_t)
    {
        //Mostrar vista para eliminar un tratamiento
        $paciente = Paciente::find($id_p);
        $tratamiento = Tratamiento::find($id_t);

        return view('panel.tratamientos.delete', compact('paciente', 'tratamiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_p, $id_t)
    {
        //Mostrar vista para editar un tratamiento
        $paciente = Paciente::find($id_p);
        $tratamiento = Tratamiento::find($id_t);

        return view('panel.tratamientos.edit', compact('paciente', 'tratamiento'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TratamientoFormRequest $request, $id_p, $id_t)
    {
        //Actualizar un tratamiento
        $tratamiento = Tratamiento::find($id_t);

        $tratamiento->droga = $request->get('droga');
        $tratamiento->dosis = $request->get('dosis');
        $tratamiento->flia_droga = $request->get('flia_droga');
        $tratamiento->fecha_trat = $request->get('fecha_trat');
        $tratamiento->obs_trat = $request->get('obs_trat');
        //$tratamiento->id_hc = $request->get('id_hc');

        $tratamiento->save();

        return redirect()->action('Panel\PanelHistoriasController@verHistoria', $id_p)->with('status', 'Tratamiento modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_p, $id_t)
    {
        //Eliminar un tratamiento
        $tratamiento = Tratamiento::find($id_t);

        $tratamiento->delete();

        return redirect()->action('Panel\PanelHistoriasController@verHistoria', $id_p)->with('status', 'Tratamiento eliminado correctamente');
    }
}
