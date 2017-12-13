<?php

namespace App\Http\Controllers\Admin;

use App\Patologia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PatologiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //Muestra patologias del sistema
        $patologias = Patologia::all();
        return view('backend.patologias.index', compact('patologias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Devuelve vista para crear una nueva patología
        return view('backend.patologias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guarda datos del formulario de patologias
        $patologia = new Patologia(array(
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
        ));

        $patologia->save();

        return redirect('/admin/patologias/')->with('status', 'La nueva patología se creó correctamente.');
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
        $patologia = Patologia::whereId($id)->firstOrFail();
        return view('backend.patologias.edit', compact('patologia'));
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
        $patologia = Patologia::whereId($id)->firstOrFail();
        $patologia->nombre = $request->get('nombre');
        $patologia->descripcion = $request->get('descripcion');
        $patologia->estado = $request->get('estado');

        $patologia->save();

        return redirect(action('Admin\PatologiasController@edit', $patologia->id))->with('status', 'La patologia fue actualizada!');
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
