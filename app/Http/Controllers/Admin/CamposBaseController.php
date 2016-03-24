<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CampoBase;
use App\UnidadMedida;
use DB;

class CamposBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Muestra todos los campos creados
        $camposBase = CampoBase::all();
        return view('backend.estudios.camposBase.index', compact('camposBase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $unidadesMedida = UnidadMedida::all();
        return view('backend.estudios.camposBase.create', compact('unidadesMedida'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Guarda datos del formulario de campos base
        $campoBase = new CampoBase(array(
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion'),
                'id_unidad' => $request->get('id_unidad'),
                'tipo' => $request->get('tipo'),
                'ref_min' => $request->get('ref_min'),
                'ref_max' => $request->get('ref_max'),
        ));
        $campoBase->save();
        //$campoBase->UnidadesMedidas()->sync($request->get('unidad_medida'));
        //$campoBase->saveUnidadMedida($request->get('unidad_medida'));

        return redirect('/admin/estudios/camposbase/create')->with('status', 'Un nuevo campo base fue creado.');
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

    public function busqueda(Request $request)
    {
        //Muestra todos los campos creados
    
        //$camposBase = CampoBase::nombre($request->get('term'))->get();
        $camposBase = DB::table('campos_base')->select('nombre')->where('nombre', 'like',$request->get('term').'%' )->get();
        $res = '';
        foreach($camposBase as $cb){
            $res[] = $cb->nombre;
        }
        return $res;
    }

    public function getAllCamposBase(){
        $campos = CampoBase::all();
        return json_encode($campos);
    }
}
