<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserEditFormRequest; //para validar formulario edit del usuario
use Illuminate\Support\Facades\Hash; //incluido para utilizar hash sobre la password
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Sede;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //Muestra todos los usuarios registrados
        $users = User::all();

        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //Asignar roles a usuario
        $user = User::whereId($id)->firstOrFail();
        $roles = Role::all();
        $sedes = Sede::all();
        $selectedRoles = $user->roles->lists('id')->toArray();
        $selectedSedes = $user->sedes->lists('id')->toArray();

        return view('backend.users.edit', compact('user', 'roles','sedes', 'selectedRoles', 'selectedSedes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id, UserEditFormRequest $request)
    {
        //Graba usuario modificado
        $user = User::whereId($id)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $password = $request->get('password');
        if($password != ""){
            $user->password = Hash::make($password);
        }
        $user->save();
        $user->saveRoles($request->get('role'));
        $user->saveSedes($request->get('sede'));

        return redirect(action('Admin\UsersController@edit', $user->id))->with('status', 'The user has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}