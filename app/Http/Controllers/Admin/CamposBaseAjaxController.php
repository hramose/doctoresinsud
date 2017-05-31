<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CampoBase;
use App\UnidadMedida;

class CamposBaseAjaxController extends Controller
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
        return $camposBase;
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
                'name' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion'),
                'tipo' => $request->get('tipo'),
                'ref_min' => $request->get('ref_min'),
                'ref_max' => $request->get('ref_max'),
        ));

        $campoBase->save();
        $campoBase->saveUnidadMedida($request->get('unidad_medida'));

        return $campoBase;
    }

   

   
}
