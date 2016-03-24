<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Estudio;
use App\CampoBase;
use App\UnidadMedida;

class EstudiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Muestra todos los estudios
        $estudios = Estudio::all();
        return view('backend.estudios.index', compact('estudios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $camposbase = CampoBase::all();
        $unidadesMedida = UnidadMedida::all();
        return view('backend.estudios.create', compact('camposbase', 'unidadesMedida'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $estudio = new Estudio(array(
            'nombre' => $request->get('nombre'),
            'observaciones' => $request->get('observaciones')
        ));

        $estudio->save();
        //$campos = $estudio->camposBase->lists('id')->toArray();
        
        $campos=array();

        $campos_base = $request->get('campobase');
        /*foreach ($campos_base as $campo) {
            if( !in_array($campo, $campos){
                $campos[]=$campo;
            }
        }*/
        //
        $estudio->saveCamposBase($campos_base);
        
        //dump($campos);die;
        return redirect('/admin/estudios/create')->with('status', 'Un nuevo estudio ha sido creado.');
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
