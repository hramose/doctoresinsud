<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SedeFormRequest;
use App\Http\Controllers\Controller;
use App\Sede;

class SedesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Muestra todas las sedes
        $sedes = Sede::all();

        return view('backend.sedes.index', compact('sedes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Muestra vista de creación de sedes
        return view('backend.sedes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SedeFormRequest $request)
    {
        //
        $sede = new Sede(array(
            'nombre' => $request->get('nombre'),
            'telefonos' => $request->get('telefonos'),
        ));

        $sede->save();

        return redirect('/admin/sedes/create')->with('status', 'Una nueva sede ha sido creada.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sede = Sede::whereId($id)->firstOrFail();
        return view('backend.sedes.show', compact('sede'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edita una sede
        $sede = Sede::whereId($id)->firstOrFail();
        return view('backend.sedes.edit', compact('sede'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SedeFormRequest $request, $id)
    {
        //Graba sede modificada
        $sede = Sede::whereId($id)->firstOrFail();
        $sede->nombre = $request->get('nombre');
        $sede->telefonos = $request->get('telefonos');

        $sede->save();

        return redirect(action('Admin\SedesController@edit', $sede->id))->with('status', 'La sede fue actualizada!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sede = Sede::whereId($id)->firstOrFail();
        $sede->delete();
        return redirect(action('Admin\SedesController@index', $sede->id))->with('status', 'La sede fue eliminada!');
    }
}
