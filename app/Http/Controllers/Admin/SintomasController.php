<?php

namespace App\Http\Controllers\Admin;

use App\Sintoma;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SintomasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Muestra sintomas del sistema
        $sintomas = Sintoma::all();
        return view('backend.sintomas.index', compact('sintomas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Devuelve vista para crear un nuevo sintoma
        return view('backend.sintomas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guarda datos del formulario de sintomas
        $sintoma = new Sintoma(array(
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
        ));

        $sintoma->save();

        return redirect('/admin/sintomas/')->with('status', 'El nuevo síntoma se creó correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sintoma = Sintoma::whereId($id)->firstOrFail();
        return view('backend.sintomas.show', compact('sintoma'));
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
        $sintoma = Sintoma::whereId($id)->firstOrFail();
        return view('backend.sintomas.edit', compact('sintoma'));
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
        $sintoma = Sintoma::whereId($id)->firstOrFail();
        $sintoma->nombre = $request->get('nombre');
        $sintoma->descripcion = $request->get('descripcion');
        $sintoma->estado = $request->get('estado');

        $sintoma->save();

        return redirect(action('Admin\SintomasController@edit', $sintoma->id))->with('status', 'El sintoma fue actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $sintoma = Sintoma::whereId($id)->firstOrFail();
          $sintoma->save();
        return redirect(action('Admin\SedesController@index', $sintoma->id))->with('status', 'El sintoma fue eliminado!');
    }
}
