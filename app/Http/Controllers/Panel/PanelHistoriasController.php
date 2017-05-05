<?php

namespace App\Http\Controllers\Panel;

use App\Consulta;
use App\EstudioPaciente;
use App\EstudioPacienteValor;
use App\Patologia;
use App\Sintoma;
use App\Tratamiento;
use App\HistorialCampo;
use Illuminate\Http\Request;

use Log;
use Exception;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paciente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Http\Requests\editHistoriaRequest;
use App\Http\Requests\crearHistoriaFormRequest;
use App\Http\Requests\ConsultaFormRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class PanelHistoriasController extends Controller
{

    public function getHCJson()
    {
        try {
            $pacientes = DB::table('pacientes')
                            ->select('id', 'id_hc', 'apellido', 'nombre', 'fecha_alta', 'fecha_ult_consulta')
                            ->get();

            return json_decode(json_encode($pacientes), true);
        } catch (Exception $e) {
            Log::error($e);
        }
        return ['error'=>500];
    }

    public function showConsulta($id_p)
    {
        $paciente = Paciente::find($id_p);
        $sintomas = Sintoma::all();
        $patologias = Patologia::all();

        return view('panel.consulta.form', compact('paciente', 'sintomas', 'patologias'));
    }

    public function nuevaConsulta(ConsultaFormRequest $request)
    {
        $consulta = Consulta::create([
            'id_usuario'    => $request->get('id_usuario'),
            'id_paciente'   => $request->get('id_paciente'),
            'titulo'        => $request->get('titulo'),
            'descripcion'   => $request->get('descripcion'),
            'proxima_cita'  => $request->get('proxima_cita'),
            'frecuencia_cardiaca' => $request->get('frecuencia_cardiaca'),
            'presion_sistolica' => $request->get('presion_sistolica'),
            'presion_diastolica' => $request->get('presion_diastolica'),
            'fecha'         => date('Y-m-d H:i:s'),
            'id_sede'       => 1
        ]);

        $consulta->saveSintomas($request->get('sintomas'));
        $consulta->savePatologias($request->get('patologias'));

        $paciente = Paciente::find($request->get('id_paciente'));
        $paciente->fecha_ult_consulta =  date('d/m/Y');
        $paciente->save();

        return redirect()->action('Panel\PanelHistoriasController@verHistoria', $paciente->id)
                         ->with('status', 'Consulta agragada correctamente.');
    }

    /**
     * Funcion llamada por Ajax para obtener los datos de la consulta que se desea editar.
     *
     * @param $id_p
     * @param $id_c
     * @return json
     */
    public function editarConsulta($id_p, $id_c)
    {
        $paciente = Paciente::find($id_p);
        $consulta = Consulta::find($id_c);
        $sintomas = Sintoma::where("estado",1)->get();
        $patologias = Patologia::where("estado",1)->get();
        $sintomasSeleccionados = $consulta->sintomas->lists('id')->toArray();
        $patologiasSeleccionadas = $consulta->patologias->lists('id')->toArray();
        return view('panel.consulta.form', compact('paciente', 'consulta', 'sintomas', 'patologias', 'sintomasSeleccionados', 'patologiasSeleccionadas'));
    }

    public function guardarConsulta(ConsultaFormRequest $request)
    {
        try {
            $consulta = Consulta::findOrFail($request->get('id_consulta'));
            $consulta->id_usuario  = $request->get('id_usuario');
            $consulta->id_paciente = $request->get('id_paciente');
            $consulta->titulo      = $request->get('titulo');
            $consulta->descripcion = $request->get('descripcion');
            $consulta->proxima_cita = $request->get('proxima_cita');
            $consulta->frecuencia_cardiaca = $request->get('frecuencia_cardiaca');
            $consulta->presion_sistolica = $request->get('presion_sistolica');
            $consulta->presion_diastolica = $request->get('presion_diastolica');
            $consulta->save();
            $consulta->saveSintomas($request->get('sintomas'));
            $consulta->savePatologias($request->get('patologias'));


//            $paciente = Paciente::find($request->get('id_paciente'));
//            $paciente->proxima_cita = $request->get('proxima_cita');
//            $paciente->save();
        } catch (Exception $e) {
            Log::error($e);
        }

        return redirect()->action('Panel\PanelHistoriasController@verHistoria', [$consulta->id_paciente, '#consultas'])
            ->with('status', 'Consulta editada correctamente')
            ->with('consulta', $consulta);
    }

    public function borrarConsulta(Request $request)
    {
    //        try {
    //            $consulta = Consulta::find($request->get('id_consulta'));
    //            $consulta->delete();
    //            return response(['status' => 201], 201);
    //        } catch (Exception $e) {
    //            Log::error($e);
    //        }
    //        return response(['error' => 500], 500);


            $consulta = Consulta::find($request->get('id_consulta'));

            $consulta->saveSintomas();

            $consulta->delete();

            return json_encode($request->get('id_consulta'));

    }

    /**
     * Funcion para ver historia clinica de un paciente.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */

    public function verHistoria($id)
    {
        $paciente = Paciente::find($id);

        $tratamientos = $paciente->tratamientos('id_paciente')
                            ->orderBy('fecha_trat', 'desc')
                            ->take(10)
                            ->get();

        $estudios = DB::table('estudios_pacientes')
                        ->join('estudios', 'estudios_pacientes.id_estudio', '=', 'estudios.id')
                        ->where('estudios_pacientes.id_hc', '=', $id)
                        ->select('estudios_pacientes.*', 'estudios.nombre')
                        ->orderBy('estudios_pacientes.fecha', 'desc')
                        ->take(10)
                        ->get();

        $consultas = $paciente->consultas()->with('medico', 'sede', 'sintomas', 'patologias')
                        ->orderBy('fecha', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->get();
         //$proximaConsulta = Consulta::where('id_paciente', $paciente->id)->max('proxima_cita');

        return view('panel.show', compact('paciente', 'tratamientos', 'estudios', 'consultas'));
    }

    /**
     * @param $id_p
     * @return \Illuminate\Http\Response
     */
    public function verTodosTratamientos($id_p)
    {
        $paciente = Paciente::find($id_p);
        $tratamientos = $paciente->tratamientos('id_paciente')->orderBy('fecha_trat', 'desc')->get();

        return view('panel.tratamientos.showall', compact('tratamientos', 'paciente'));
    }

    /**
     * @param $id_p
     * @return \Illuminate\Http\Response
     */
    public function verTodosEstudios($id_p)
    {
        $estudios = DB::table('estudios_pacientes')
            ->join('estudios', 'estudios_pacientes.id_estudio', '=', 'estudios.id')
            ->where('estudios_pacientes.id_hc', '=', $id_p)
            ->select('estudios_pacientes.*', 'estudios.nombre')
            ->orderBy('estudios_pacientes.fecha', 'desc')
            ->get();

        return view('panel.estudios.showall', compact('estudios'));
    }


    /**
     * @return mixed
     */
    public function verEstudio($id_p, $id_e)
    {
        $estudioPaciente = EstudioPaciente::with('valores.campoBase.UnidadMedida', 'estudio')->find($id_e);
        $paciente = DB::table('pacientes')->select('id', 'id_hc', 'apellido', 'nombre')->where('id', $id_p)->get();
        return view('panel.estudios.show', compact('paciente', 'estudioPaciente'));
    }

    /**
     * @return mixed
     */
    public function verTratamiento($id_p, $id_t)
    {
        $paciente = DB::table('pacientes')->select('id', 'id_hc', 'apellido', 'nombre')->where('id', $id_p)->get();
        $tratamiento = Tratamiento::find($id_t);
        return view('panel.tratamientos.show', compact('paciente', 'tratamiento'));
    }

    public function index()
    {
        return view('panel.index');
    }

 public function historial(Request $request)
    {

        $historialModel= new HistorialCampo();
        $recurso=$request->get("recurso");
        $field=$request->get("field");
        $tipo=$request->get("tipo");
        $getHistorialByResource= $historialModel->getHistorialByResource($recurso,$field,$tipo);

        return view('panel.historial')->with("historial",$getHistorialByResource);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(crearHistoriaFormRequest $request)
    {
        //TODO: Desarrollar función que reciba un form request validado y lo guarde en la base de datos. Luego redirija a la vista panel.show
        //$idHistoria = (int) $request->get('numero_doc');
        //dd(var_dump($request));
        $paciente = new Paciente(array(
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'tipo_doc' => $request->get('tipo_doc'),
            //'id_hc' => (int) $request->get('id_hc'),
            'numero_doc' => $request->get('numero_doc'),
            'fecha_nac' => $request->get('fecha_nac'), //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_nac')))->format('Y-m-d');
            'fecha_alta' => $request->get('fecha_alta'), //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_alta')))->format('Y-m-d');
            'fecha_ult_consulta' => $request->get('fecha_ult_consulta'), //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_ult_consulta')))->format('Y-m-d');
            'proxima_cita' => $request->get('proxima_cita'),//Carbon::createFromFormat('d/m/Y',trim($request->get('proxima_cita')))->format('Y-m-d');
            'ecg' => $request->get('ecg'),
            'tipo_ecg' => $request->get('tipo_ecg'),
            'nuevos_cambios_ecg' => $request->get('nuevos_cambios_ecg'),
            'fecha_cambios_ecg' => $request->get('fecha_cambios_ecg'),//Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_cambios_ecg')))->format('Y-m-d');
            'tipo_cambio_ecg' => $request->get('tipo_cambio_ecg'),
            'obs_ecg' => $request->get('obs_ecg'),
            'grupo_clinico_ing' => $request->get('grupo_clinico_ing'),
            'cambio_grupo_cli' => $request->get('cambio_grupo_cli'),
            'fecha_cambio_gcli' => $request->get('fecha_cambio_gcli'), //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_cambio_gcli')))->format('Y-m-d');
            'nuevo_grupo_cli' => $request->get('nuevo_grupo_cli'),
            'causa_muerte' => $request->get('causa_muerte'),
            'trat_bnz' => $request->has('trat_bnz') ? 2 : 1,
            'efectos_adv_bnz' => $request->has('efectos_adv_bnz') ? 2 : 1,
            'efec_rash_bnz' => $request->has('efec_rash_bnz') ? 2 : 1,
            'efec_intgas_bnz' => $request->has('efec_intgas_bnz') ? 2 : 1,
            'efec_afhep_bnz' => $request->has('efec_afhep_bnz') ? 2 : 1,
            //Prueba
            'efec_afneur_bnz' => $request->has('efec_afneur_bnz') ? 2 : 1,
            //Fin prueba
            'efec_afhem_bnz' => $request->has('efec_afhem_bnz') ? 2 : 1,
            'susp_bnz' => $request->has('susp_bnz') ? 2 : 1,
            'fecha_ini_trat_bnz' => $request->get('fecha_ini_trat_bnz'),//Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_ini_trat_bnz')))->format('Y-m-d');
            'efec_otros_bnz' => $request->get('efec_otros_bnz'),
            'trat_nifur' => $request->has('trat_nifur') ? 2 : 1,
            'efectos_adv_nifur' => $request->has('efectos_adv_nifur') ? 2 : 1,
            'efec_rash_nifur' => $request->has('efec_rash_nifur') ? 2 : 1,
            'efec_intgas_nifur' => $request->has('efec_intgas_nifur') ? 2 : 1,
            'efec_afhep_nifur' => $request->has('efec_afhep_nifur') ? 2 : 1,
            'efec_afneur_nifur' => $request->has('efec_afneur_nifur') ? 2 : 1,
            'efec_afhem_nifur' => $request->has('efec_afhem_nifur') ? 2 : 1,
            'susp_nifur' => $request->has('susp_nifur') ? 2 : 1,
            'fecha_ini_trat_nifur' => $request->get('fecha_ini_trat_nifur'),//Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_ini_trat_nifur')))->format('Y-m-d');
            'efec_otros_nifur' => $request->get('efec_otros_nifur'),
            'sin_patologia' => $request->has('sin_patologia') ? 2 : 1,
            'tuberculosis' => $request->has('tuberculosis') ? 2 : 1,
            'epoc' => $request->has('epoc') ? 2 : 1,
            'dbt' => $request->has('dbt') ? 2 : 1,
            'asintomatico' => $request->has('asintomatico') ? 2 : 1,
            'palpitaciones' => $request->has('palpitaciones') ? 2 : 1,
            'angor' => $request->has('angor') ? 2 : 1,
            'colageno' => $request->has('colageno') ? 2 : 1,
            'obesidad' => $request->has('obesidad') ? 2 : 1,
            'alcoholismo' => $request->has('alcoholismo') ? 2 : 1,
            'acv' => $request->has('acv') ? 2 : 1,
            'disnea' => $request->has('disnea') ? 2 : 1,
            'disnea1' => $request->has('disnea1') ? 2 : 1,
            'disnea2' => $request->has('disnea2') ? 2 : 1,
            'disnea3' => $request->has('disnea3') ? 2 : 1,
            'disnea4' => $request->has('disnea4') ? 2 : 1,
            'hipotiroidismo' => $request->has('hipotiroidismo') ? 2 : 1,
            'hipertiroidismo' => $request->has('hipertiroidismo') ? 2 : 1,
            'cardio_congenitas' => $request->has('cardio_congenitas') ? 2 : 1,
            'valvulopatias' => $request->has('valvulopatias') ? 2 : 1,
            'mareos' => $request->has('mareos') ? 2 : 1,
            'cardio_isquemica' => $request->has('cardio_isquemica') ? 2 : 1,
            'ht_arterial_leve' => $request->has('ht_arterial_leve') ? 2 : 1,
            'ht_arterial_mode' => $request->has('ht_arterial_mode') ? 2 : 1,
            'ht_arterial_severa' => $request->has('ht_arterial_severa') ? 2 : 1,
            'perdida_conoc' => $request->has('perdida_conoc') ? 2 : 1,
            'insuf_cardiaca' => $request->has('insuf_cardiaca') ? 2 : 1,
            'tipo_insuf_card' => $request->get('tipo_insuf_card'),
            'trat_etio_obs' => $request->get('trat_etio_obs'),
            'otras_pat_asoc' => $request->get('otras_pat_asoc'),
            'otros_sintomas_ing' => $request->get('otros_sintomas_ing'),
            'nuevos_sintomas' => $request->get('nuevos_sintomas') == 'S' ? 'S' : 'N',
            'obs_sintomas' => $request->get('obs_sintomas'),
            'tres_negativas' => $request->has('tres_negativas') ? 2 : 1,
            'serologia_ing' => $request->get('serologia_ing'),
            'titulos_sero_ing' => $request->get('titulos_sero_ing'),
            'trat_etio' => $request->get('trat_etio') == 'S' ? 'S' : 'N',
            'fecha_rx_torax' => $request->get('fecha_rx_torax'), //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_rx_torax')))->format('Y-m-d');
            'rx_torax' => $request->get('rx_torax') == 'S' ? 'S' : 'N',
            'indice_cardiotorax' => $request->get('indice_cardiotorax'),
            'obs_rxt' => $request->get('obs_rxt'),
            'cambios_rxt' => $request->get('cambios_rxt') == 'S' ? 'S' : 'N',
            'fecha_cambios_rxt' => $request->get('fecha_cambios_rxt'), //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_cambios_rxt')))->format('Y-m-d');
            'nueva_rxt' => $request->get('nueva_rxt')
        ));

        $paciente->id_hc = (int) $request->get('id_hc');


        $paciente->save();

       // return redirect()->action('Panel\PanelHistoriasController@verHistoria', $paciente->id)->with('status', 'Nueva historia clínica agregada correctamente.');
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
        //TODO: Desarrollar función para editar una historia clínica
        $paciente = Paciente::find($id);

        $consultas = $paciente->consultas()->get();
        
        $maxConsulta = $consultas->max('fecha');
            
        return view('panel.edit', compact('paciente', 'maxConsulta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editHistoriaRequest $request, $id)
    {
        //TODO: Desarrollar función para actualizar una historia clínica
        //dd(Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_alta')))->format('Y-m-d'));
        //dd($request);
        $paciente = Paciente::find($id);

        $paciente->tipo_doc = $request->get('tipo_doc');
        $paciente->numero_doc = $request->get('numero_doc');
        $paciente->fecha_nac = $request->get('fecha_nac'); //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_nac')))->format('Y-m-d');
        $paciente->fecha_alta = $request->get('fecha_alta'); //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_alta')))->format('Y-m-d');
        $paciente->fecha_ult_consulta = $request->get('fecha_ult_consulta'); //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_ult_consulta')))->format('Y-m-d');
        $paciente->proxima_cita = $request->get('proxima_cita');//Carbon::createFromFormat('d/m/Y',trim($request->get('proxima_cita')))->format('Y-m-d');
        $paciente->ecg = $request->get('ecg');
        $paciente->tipo_ecg = $request->get('tipo_ecg');
        $paciente->nuevos_cambios_ecg = $request->get('nuevos_cambios_ecg');
        $paciente->fecha_cambios_ecg = $request->get('fecha_cambios_ecg');//Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_cambios_ecg')))->format('Y-m-d');
        $paciente->tipo_cambio_ecg = $request->get('tipo_cambio_ecg');
        $paciente->obs_ecg = $request->get('obs_ecg');
        $paciente->grupo_clinico_ing = $request->get('grupo_clinico_ing');
        $paciente->cambio_grupo_cli = $request->get('cambio_grupo_cli');
        $paciente->fecha_cambio_gcli = $request->get('fecha_cambio_gcli'); //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_cambio_gcli')))->format('Y-m-d');
        $paciente->nuevo_grupo_cli = $request->get('nuevo_grupo_cli');
        $paciente->causa_muerte = $request->get('causa_muerte');
        $paciente->trat_bnz = $request->get('trat_bnz') == 'on' ? 2 : 1;
        $paciente->efectos_adv_bnz = $request->get('efectos_adv_bnz') == 'on' ? 2 : 1;
        $paciente->efec_rash_bnz = $request->get('efec_rash_bnz') == 'on' ? 2 : 1;
        $paciente->efec_intgas_bnz = $request->get('efec_intgas_bnz') == 'on' ? 2 : 1;
        $paciente->efec_afhep_bnz = $request->get('efec_afhep_bnz') == 'on' ? 2 : 1;
        $paciente->efec_afneur_bnz = $request->get('efec_afneur_bnz') == 'on' ? 2 : 1;
        $paciente->efec_afhem_bnz = $request->get('efec_afhem_bnz') == 'on' ? 2 : 1;
        $paciente->susp_bnz = $request->get('susp_bnz') == 'on' ? 2 : 1;
        $paciente->fecha_ini_trat_bnz = $request->get('fecha_ini_trat_bnz');//Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_ini_trat_bnz')))->format('Y-m-d');
        $paciente->efec_otros_bnz = $request->get('efec_otros_bnz');
        $paciente->trat_nifur = $request->get('trat_nifur') == 'on' ? 2 : 1;
        $paciente->efectos_adv_nifur = $request->get('efectos_adv_nifur') == 'on' ? 2 : 1;
        $paciente->efec_rash_nifur = $request->get('efec_rash_nifur') == 'on' ? 2 : 1;
        $paciente->efec_intgas_nifur = $request->get('efec_intgas_nifur') == 'on' ? 2 : 1;
        $paciente->efec_afhep_nifur = $request->get('efec_afhep_nifur') == 'on' ? 2 : 1;
        $paciente->efec_afneur_nifur = $request->get('efec_afneur_nifur') == 'on' ? 2 : 1;
        $paciente->efec_afhem_nifur = $request->get('efec_afhem_nifur') == 'on' ? 2 : 1;
        $paciente->susp_nifur = $request->get('susp_nifur') == 'on' ? 2 : 1;
        $paciente->fecha_ini_trat_nifur = $request->get('fecha_ini_trat_nifur');//Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_ini_trat_nifur')))->format('Y-m-d');
        $paciente->efec_otros_nifur = $request->get('efec_otros_nifur');
        $paciente->sin_patologia = $request->get('sin_patologia') == 'on' ? 2 : 1;
        $paciente->tuberculosis = $request->get('tuberculosis') == 'on' ? 2 : 1;
        $paciente->epoc = $request->get('epoc') == 'on' ? 2 : 1;
        $paciente->dbt = $request->get('dbt') == 'on' ? 2 : 1;
        $paciente->asintomatico = $request->get('asintomatico') == 'on' ? 2 : 1;
        $paciente->palpitaciones = $request->get('palpitaciones') == 'on' ? 2 : 1;
        $paciente->angor = $request->get('angor') == 'on' ? 2 : 1;
        $paciente->colageno = $request->get('colageno') == 'on' ? 2 : 1;
        $paciente->obesidad = $request->get('obesidad') == 'on' ? 2 : 1;
        $paciente->alcoholismo = $request->get('alcoholismo') == 'on' ? 2 : 1;
        $paciente->acv = $request->get('acv') == 'on' ? 2 : 1;
        $paciente->disnea = $request->get('disnea') == 'on' ? 2 : 1;
        $paciente->disnea1 = $request->get('disnea1') == 'on' ? 2 : 1;
        $paciente->disnea2 = $request->get('disnea2') == 'on' ? 2 : 1;
        $paciente->disnea3 = $request->get('disnea3') == 'on' ? 2 : 1;
        $paciente->disnea4 = $request->get('disnea4') == 'on' ? 2 : 1;
        $paciente->hipotiroidismo = $request->get('hipotiroidismo') == 'on' ? 2 : 1;
        $paciente->hipertiroidismo = $request->get('hipertiroidismo') == 'on' ? 2 : 1;
        $paciente->cardio_congenitas = $request->get('cardio_congenitas') == 'on' ? 2 : 1;
        $paciente->valvulopatias = $request->get('valvulopatias') == 'on' ? 2 : 1;
        $paciente->mareos = $request->get('mareos') == 'on' ? 2 : 1;
        $paciente->cardio_isquemica = $request->get('cardio_isquemica') == 'on' ? 2 : 1;
        $paciente->ht_arterial_leve = $request->get('ht_arterial_leve') == 'on' ? 2 : 1;
        $paciente->ht_arterial_mode = $request->get('ht_arterial_mode') == 'on' ? 2 : 1;
        $paciente->ht_arterial_severa = $request->get('ht_arterial_severa') == 'on' ? 2 : 1;
        $paciente->perdida_conoc = $request->get('perdida_conoc') == 'on' ? 2 : 1;
        $paciente->insuf_cardiaca = $request->get('insuf_cardiaca') == 'on' ? 2 : 1;
        $paciente->tipo_insuf_card = $request->get('tipo_insuf_card');
        $paciente->trat_etio_obs = $request->get('trat_etio_obs');
        $paciente->otras_pat_asoc = $request->get('otras_pat_asoc');
        $paciente->otros_sintomas_ing = $request->get('otros_sintomas_ing');
        $paciente->nuevos_sintomas = $request->get('nuevos_sintomas') == 'S' ? 'S' : 'N';
        $paciente->obs_sintomas = $request->get('obs_sintomas');
        $paciente->tres_negativas = $request->get('tres_negativas') == 'on' ? 2 : 1;
        $paciente->serologia_ing = $request->get('serologia_ing');
        $paciente->titulos_sero_ing = $request->get('titulos_sero_ing');
        $paciente->trat_etio = $request->get('trat_etio') == 'S' ? 'S' : 'N';
        $paciente->fecha_rx_torax = $request->get('fecha_rx_torax'); //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_rx_torax')))->format('Y-m-d');
        $paciente->rx_torax = $request->get('rx_torax') == 'S' ? 'S' : 'N';
        $paciente->indice_cardiotorax = $request->get('indice_cardiotorax');
        $paciente->obs_rxt = $request->get('obs_rxt');
        $paciente->cambios_rxt = $request->get('cambios_rxt') == 'S' ? 'S' : 'N';
        $paciente->fecha_cambios_rxt = $request->get('fecha_cambios_rxt'); //Carbon::createFromFormat('d/m/Y',trim($request->get('fecha_cambios_rxt')))->format('Y-m-d');
        $paciente->nueva_rxt = $request->get('nueva_rxt');
        $paciente->evolucion = $request->get('evolucion');

        $paciente->save();

         $this->actualizarHistorial($paciente->toArray(),$id);
       
      return redirect()->action('Panel\PanelHistoriasController@verHistoria', $paciente->id)->with('status', 'Historia clínica editada correctamente.');
    }

   public function actualizarHistorial($historial,$recurso){
        foreach ($historial as $key=> $value) {

            $historial = DB::table('historial_campo')
            ->where('field',$key)
            ->where('recurso',$recurso)
            ->orderBy('created_at','desc')
            ->first();
            $valueG="";

 
            if($key =="grupo_clinico_ing"  ||   $key=="nuevo_grupo_cli" ||   $key =="tipo_ecg"  ||   $key =="nuevos_cambios_ecg" ||   $key =="obs_ecg"  ||   $key =="efec_otros_bnz" ||   $key =="efec_otros_nifur" ||   $key =="trat_etio_obs" ||   $key =="otras_pat_asoc" ||   $key =="otros_sintomas_ing" ||   $key =="tipo_insuf_card"){

                           $valueG=$value;

                    }else{
                    
                        if($value=="1"){
                            $valueG="NO";
                        }else if($value=="2") {
                            $valueG="SI";
                        }else{
                           $valueG=$value;
                        }

                    }

             if( count($historial)>0){
                if($historial->valor!=$valueG){
                    $historialModel= new HistorialCampo();
                    $historialModel->field=$key;
                    $historialModel->recurso=$recurso;
                    $historialModel->valor=$valueG;
                    $historialModel->tipo=1;
                    $historialModel->user_id=Auth::id();
                    $historialModel->save();
                }
             }else{
                $historialModel= new HistorialCampo();
                $historialModel->field=$key;
                $historialModel->recurso=$recurso;
                $historialModel->valor=$valueG;
                $historialModel->tipo=1;
                $historialModel->user_id=Auth::id();
                $historialModel->save();
             }
        }
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
