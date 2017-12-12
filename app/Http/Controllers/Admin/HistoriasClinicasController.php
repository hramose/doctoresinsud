<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use App\User;
use App\Paciente;
use App\Item_hc;
use App\Http\Requests\ItemFormRequest;


class HistoriasClinicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $pacientes = Paciente::all();
        $medicos = User::all();
        $items_hc =  Item_hc::all();
        
        return view('backend.items.index', compact('pacientes','medicos','items_hc'));
    }


    public function getPacientesByMedico(Request $request,$id){
        
        $dato = $request->get('elegido');
        //$dato=$id;
      //  dump($dato);
        
        if($id != ''){
            $user = User::find($id);
            $pacientes = $user->pacientes;
        
            
        }else{
            $pacientes = "";    
            
        }
        return compact('pacientes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::all();
        $pacientes = Paciente::all();
        return view('backend.items.create', compact( 'usuarios','pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemFormRequest $request)
    {
       //
        $item = new Item_hc(array(
            'id_sede' => 1,
            'id_usuario' => $request->get('user'),
            'id_paciente' => $request->get('id_paciente'),
            'titulo' => $request->get('titulo'),
            'descripcion' => $request->get('descripcion'),
            'path' => $request->get('path')


        ));

        $item->save();
        

        return redirect('/admin/items/create')->with('status', 'Un item de historia clínica ha sido creado.');
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
