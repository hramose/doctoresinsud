<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paciente;
use App\User;
use App\Http\Requests\PacienteFormRequest;


class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all();
        $usuarios = User::all();

        return view('backend.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::all();
        return view('backend.pacientes.create', compact( 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteFormRequest $request)
    {
        //
        $paciente = new Paciente(array(
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'telefono' => $request->get('telefono'),
            'direccion' => $request->get('direccion'),
            'sexo' => $request->get('sexo'),
            'email' => $request->get('email'),
            'origen' => $request->get('origen')


        ));

        $paciente->save();
        $paciente->saveMedico($request->get('medico'));

        return redirect('/admin/pacientes/create')->with('status', 'Un nuevo paciente ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::whereId($id)->firstOrFail();
        $usuarios = User::all();
        $selectedUsers = $paciente->users->lists('id')->toArray();
        
       
        return view('backend.pacientes.show', compact('paciente', 'usuarios','selectedUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $paciente = Paciente::whereId($id)->firstOrFail();
        $usuarios = User::all();
        $selectedUsers = $paciente->users->lists('id')->toArray();
        

        return view('backend.pacientes.edit', compact('paciente', 'usuarios','selectedUsers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteFormRequest $request, $id)
    {
        //Graba paciente modificado
        $paciente = Paciente::whereId($id)->firstOrFail();
            $paciente->nombre =$request->get('nombre');
            $paciente->apellido = $request->get('apellido');
            $paciente->telefono = $request->get('telefono');
            $paciente->direccion = $request->get('direccion');
            $paciente->sexo = $request->get('sexo');
            $paciente->email = $request->get('email');
            $paciente->origen = $request->get('origen');
        
        $paciente->save();
        $paciente->saveMedico($request->get('medico'));
        

        return redirect(action('Admin\PacientesController@index', $paciente->id))->with('status', 'El paciente ha sido actualizado!');
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
