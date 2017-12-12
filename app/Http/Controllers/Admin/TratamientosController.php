<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TratamientoFormRequest;
use App\Http\Controllers\Controller;
use App\Tratamiento;

class TratamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tratamientos = Tratamiento::all();
        return view('backend.tratamientos.index', compact('tratamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tratamientos = Tratamiento::all();
        return view('backend.tratamientos.create', compact( 'tratamientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TratamientoFormRequest $request)
    {
        //
        $tratamiento = new Tratamiento(array(
            'titulo' => $request->get('titulo'),
            'descripcion' => $request->get('descripcion'),
            'observaciones' => $request->get('observaciones')
           
        ));

        $tratamiento->save();
        
        return redirect('/admin/tratamientos/create')->with('status', 'Un nuevo tratamiento ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tratamiento = Tratamiento::whereId($id)->firstOrFail();
             
       
        return view('backend.tratamientos.show', compact('tratamiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tratamiento = Tratamiento::whereId($id)->firstOrFail();
        

        return view('backend.tratamientos.edit', compact('tratamiento'));
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
         $tratamiento = Tratamiento::whereId($id)->firstOrFail();
         $tratamiento->titulo =$request->get('titulo');
         $tratamiento->descripcion = $request->get('descripcion');
         $tratamiento->observaciones = $request->get('observaciones');
         $tratamiento->save();
        
        

        return redirect(action('Admin\TratamientosController@index', $tratamiento->id))->with('status', 'El tratamiento ha sido actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tratamiento = Tratamiento::whereId($id)->firstOrFail();
        $tratamiento.delete();
        return redirect(action('Admin\TratamientosController@index', $tratamiento->id))->with('status', 'El tratamiento ha sido eliminado!');
    }
}
