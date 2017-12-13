<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Estudio;
use App\CampoBase;
use App\UnidadMedida;
use JavaScript;
use Illuminate\Support\Facades\DB;

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
        //$camposbase = DB::table('campos_base')->select('id', 'descripcion')->get();

/*        $array_campos_desc = array();
        $array_campos_id = array();

        foreach($camposbase as $campo){
            array_push($array_campos_desc, $campo->descripcion);
            array_push($array_campos_id, $campo->id);
        }*/

        //JavaScript::put(['array_campos_desc' => $array_campos_desc, 'array_campos_id' => $array_campos_id, 'camposbase' => $camposbase]);

        //$unidadesMedida = UnidadMedida::all();
        return view('backend.estudios.create', compact('camposbase'/*, 'unidadesMedida'*/));
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
            'obs' => $request->get('observaciones')
        ));
        //var_dump($_POST); die;
        $estudio->save();
        //$campos = $estudio->camposBase->lists('id')->toArray();
        
        $campos=array();

        $campos_base = $request->get('campos');
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
        $estudio = Estudio::whereId($id)->firstOrFail();
        $camposbase = CampoBase::all();
        $camposSeleccionados = $estudio->camposBase->lists('id')->toArray();

        return view('backend.estudios.edit', compact('estudio', 'camposbase','camposSeleccionados'));
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
        //Graba estudio modificado

        //Graba paciente modificado
        $estudio = Estudio::whereId($id)->firstOrFail();
        $estudio->nombre =$request->get('nombre');
        $estudio->obs =$request->get('observaciones');

        $estudio->save();

        $estudio->saveCamposBase($request->get('campos'));

        return redirect(action('Admin\EstudiosController@index', $estudio->id))->with('status', 'El estudio ha sido actualizado!');
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
