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
        //TODO: Para crear un nuevo tratamiento, muestra la vista de creación
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
