<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Estudio;
use App\CampoBase;

class EstudiosAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    { 
        $camposbase = CampoBase::all();
        return view('backend.estudios.create', compact('camposbase'));
    }

   
}
