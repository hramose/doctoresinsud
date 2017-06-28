<?php

namespace App\Http\Controllers\Panel;

use App\Epidemiologia;
use App\Paciente;
use App\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EpidemiologiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id_p)
    {
        //Muestra datos socio-eco, familiares y epidemiológicos para editar o crear
        $paciente = Paciente::with('epidemiologia')->find($id_p);

        if(! $paciente->epidemiologia){
            $paciente->epidemiologia = new Epidemiologia();

   
        }
 
           
        $places = Place::select('name',"id")->get();
        $placesArray=array();
        foreach ($places as  $value) {
             $placesArray[$value->id]=$value->name;
        }

 
        $placesSelected=$paciente->epidemiologia->places;

        $arraySelected=array();

        foreach ($placesSelected as   $ps) {
             $arraySelected[]=$ps->id;
        }
          //dd($paciente->epidemiologia);
        return view('panel.epidemiologias.edit', compact('paciente'))->with("places",$placesArray)->with("selectedPlaces",$arraySelected);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response    
     */
    public function update(Requests\EpidemiologiaFormRequest $request, $id)
    {
        //Actualiza o crea un nuevo registro de epidemiologia
        $epidemiologia = Epidemiologia::find($request->get('epidemiologia_id'));

//dd($request->all());


        if(is_null($epidemiologia)){
            $epidemiologia = new Epidemiologia();
        }
        
        $epidemiologia->id_paciente = $id;
        $epidemiologia->sexo = $request->get('sexo');
        $epidemiologia->estado_civil = $request->get('estado_civil');
        $epidemiologia->dador_sangre = $request->get('dador_sangre');
        $epidemiologia->dador_sangre_cant = $request->get('dador_sangre_cant');
        $epidemiologia->dador_sangre_hosp = $request->get('dador_sangre_hosp');
        $epidemiologia->recep_sangre = $request->get('recep_sangre');
        $epidemiologia->recep_sangre_hosp = $request->get('recep_sangre_hosp');
        $epidemiologia->recep_sangre_motivo = $request->get('recep_sangre_motivo');
        $epidemiologia->localidad_nac = $request->get('localidad_nac');
        $epidemiologia->provincia_nac = $request->get('provincia_nac');
        $epidemiologia->pais_nac = $request->get('pais_nac');
        $epidemiologia->conoce_vinchuca = $request->get('conoce_vinchuca');
        $epidemiologia->puerta_entrada = $request->get('puerta_entrada');
        $epidemiologia->sabe_chagasico = $request->get('sabe_chagasico');
        $epidemiologia->motivo_det_chagas = $request->get('motivo_det_chagas');
        $epidemiologia->fecha_det_chagas = $request->get('fecha_det_chagas');
        $epidemiologia->confirmacion_chagas = $request->get('confirmacion_chagas');
        $epidemiologia->lugar_nac_urbanizado = $request->get('lugar_nac_urbanizado');
        $epidemiologia->tipo_vivienda_nac = $request->get('tipo_vivienda_nac');
        $epidemiologia->anios_area_endemica = $request->get('anios_area_endemica');
        $epidemiologia->tipo_residencia_ende = $request->get('tipo_residencia_ende');
        $epidemiologia->volvio_area_ende = $request->get('volvio_area_ende');
        $epidemiologia->volvio_reciente_ende = $request->get('volvio_reciente_ende');
        $epidemiologia->fecha_cuando_volvio_ende = $request->get('fecha_cuando_volvio_ende');
        $epidemiologia->otras_areas_ende = $request->get('otras_areas_ende');
        $epidemiologia->otras_areas_ende_lugar = $request->get('otras_areas_ende_lugar');
        $epidemiologia->otras_areas_ende_tiempo = $request->get('otras_areas_ende_tiempo');
        $epidemiologia->antefam_descrip = $request->get('antefam_descrip');
        $epidemiologia->conyuge = $request->get('conyuge');
        $epidemiologia->cant_hijos = $request->get('cant_hijos');
        $epidemiologia->cant_pers_casa = $request->get('cant_pers_casa');
        $epidemiologia->cant_habit_casa = $request->get('cant_habit_casa');
        $epidemiologia->agua = $request->get('agua');
        $epidemiologia->canieria = $request->get('canieria');
        $epidemiologia->sanitario = $request->get('sanitario');
        $epidemiologia->escolaridad = $request->get('escolaridad');
        $epidemiologia->grados_aprobados = $request->get('grados_aprobados');
        $epidemiologia->trabajo = $request->get('trabajo');
        $epidemiologia->tipo_trabajo = $request->get('tipo_trabajo');
        $epidemiologia->rechazado_empleo_chagas = $request->get('rechazado_empleo_chagas');
        $epidemiologia->nombre_empresa_rech = $request->get('nombre_empresa_rech');
        $epidemiologia->obra_social = $request->get('obra_social');
        $epidemiologia->cant_conviv_trabajan = $request->get('cant_conviv_trabajan');
        $epidemiologia->antefam_muerte_sub_no = $request->get('antefam_muerte_sub_no') == 'on' ? 2 : 1;
        $epidemiologia->antefam_muerte_sub_si = $request->get('antefam_muerte_sub_si') == 'on' ? 2 : 1;
        $epidemiologia->antefam_muerte_sub_ns = $request->get('antefam_muerte_sub_ns') == 'on' ? 2 : 1;
        $epidemiologia->antefam_muerte_sub_padre = $request->get('antefam_muerte_sub_padre') == 'on' ? 2 : 1;
        $epidemiologia->antefam_muerte_sub_madre = $request->get('antefam_muerte_sub_madre') == 'on' ? 2 : 1;
        $epidemiologia->antefam_muerte_sub_hermano = $request->get('antefam_muerte_sub_hermano') == 'on' ? 2 : 1;
        $epidemiologia->antefam_muerte_sub_hijo = $request->get('antefam_muerte_sub_hijo') == 'on' ? 2 : 1;
        $epidemiologia->antefam_muerte_sub_otros = $request->get('antefam_muerte_sub_otros') == 'on' ? 2 : 1;
        $epidemiologia->antefam_muerte_sub_desc = $request->get('antefam_muerte_sub_desc') == 'on' ? 2 : 1;
        $epidemiologia->antefam_afcardi_no = $request->get('antefam_afcardi_no') == 'on' ? 2 : 1;
        $epidemiologia->antefam_afcardi_si = $request->get('antefam_afcardi_si') == 'on' ? 2 : 1;
        $epidemiologia->antefam_afcardi_ns = $request->get('antefam_afcardi_ns') == 'on' ? 2 : 1;
        $epidemiologia->antefam_afcardi_padre = $request->get('antefam_afcardi_padre') == 'on' ? 2 : 1;
        $epidemiologia->antefam_afcardi_madre = $request->get('antefam_afcardi_madre') == 'on' ? 2 : 1;
        $epidemiologia->antefam_afcardi_hermano = $request->get('antefam_afcardi_hermano') == 'on' ? 2 : 1;
        $epidemiologia->antefam_afcardi_hijo = $request->get('antefam_afcardi_hijo') == 'on' ? 2 : 1;
        $epidemiologia->antefam_afcardi_otros = $request->get('antefam_afcardi_otros') == 'on' ? 2 : 1;
        $epidemiologia->antefam_afcardi_desc = $request->get('antefam_afcardi_desc') == 'on' ? 2 : 1;
        $epidemiologia->antefam_chagas_no = $request->get('antefam_chagas_no') == 'on' ? 2 : 1;
        $epidemiologia->antefam_chagas_si = $request->get('antefam_chagas_si') == 'on' ? 2 : 1;
        $epidemiologia->antefam_chagas_ns = $request->get('antefam_chagas_ns') == 'on' ? 2 : 1;
        $epidemiologia->antefam_chagas_padre = $request->get('antefam_chagas_padre') == 'on' ? 2 : 1;
        $epidemiologia->antefam_chagas_madre = $request->get('antefam_chagas_madre') == 'on' ? 2 : 1;
        $epidemiologia->antefam_chagas_hermano = $request->get('antefam_chagas_hermano') == 'on' ? 2 : 1;
        $epidemiologia->antefam_chagas_hijo = $request->get('antefam_chagas_hijo') == 'on' ? 2 : 1;
        $epidemiologia->antefam_chagas_otros = $request->get('antefam_chagas_otros') == 'on' ? 2 : 1;
        $epidemiologia->antefam_chagas_desc = $request->get('antefam_chagas_desc') == 'on' ? 2 : 1;
        $epidemiologia->embarazo = $request->get('embarazo') == 'on' ? 2 : 1;

        $epidemiologia->save();

        $arrayPlaces=array();
        if($request->has('places')){
            foreach ($request->get('places') as $key ) {
                if(!is_numeric($key)){
                    $place= new Place();
                    $place->name=$key;
                    $place->save();
                    $arrayPlaces[]= $place->id;

                }else{
                    $arrayPlaces[]=$key;
                } 
            }
                    $epidemiologia->savePlaces($arrayPlaces);

        }else{
                    $epidemiologia->savePlaces($$request->has('places'));

        }

 
 
        return redirect()->action('Panel\PanelHistoriasController@verHistoria', $id)->with('status', 'Datos familiares, socio-económicos y epidemiológicos actualizados correctamente');
        
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
