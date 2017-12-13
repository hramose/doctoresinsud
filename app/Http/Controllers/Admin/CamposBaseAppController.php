<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Request as Req;
use App\Http\Controllers\Controller;
use App\CampoBase;
use App\UnidadMedida;

class CamposBaseAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$unidadesMedida = UnidadMedida::all();
        return view('backend.estudios.camposBase.create', compact('unidadesMedida'));
    }

    
    public function store(){
    	
        $campobase = new CampoBase(Req::all());
        $campobase->save();
        return $campobase;
    }
    
   

   
}
