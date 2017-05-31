<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    //Controlador de paginas del sitio

    public function home()
    {

        $hoy = Carbon::now(-3);

        $proximasCitas = DB::table('item_hcs')
            ->join('pacientes', 'pacientes.id', '=', 'item_hcs.id_paciente')
            ->where('item_hcs.proxima_cita', '>=', $hoy )
            ->whereNotNull('item_hcs.proxima_cita')
            ->where('item_hcs.proxima_cita', '<>', '0000-00-00' )
            ->selectRaw('pacientes.id, pacientes.id_hc, pacientes.apellido, pacientes.nombre, pacientes.fecha_ult_consulta, min(item_hcs.proxima_cita) as min_proxima_cita')
            ->groupBy('pacientes.id', 'pacientes.id_hc', 'pacientes.apellido', 'pacientes.nombre', 'pacientes.fecha_ult_consulta')
            ->orderBy('min_proxima_cita', 'asc')
            ->take(20)
            ->get();

        $ultimasConsultas =  DB::table('pacientes')
            ->where('fecha_ult_consulta', '<=', $hoy )
            ->whereNotNull('fecha_ult_consulta')
            ->where('fecha_ult_consulta', '<>', '0000-00-00' )
            ->select('id', 'id_hc', 'apellido', 'nombre', 'fecha_ult_consulta')
            ->orderBy('fecha_ult_consulta', 'desc')
            ->take(20)
            ->get();

    	return view('home', compact('proximasCitas', 'ultimasConsultas'));
    }

    public function about()
    {
    	return view('about');
    }

    public function contact()
    {
    	return view('tickets.create');
    }

    public function vue()
    {
        return view('tests.vue');
    }

    public function vueSuscription()
    {
        return view('tests.vue_suscription');
    }

    public function vueLists()
    {
        return view('tests.vue_lists');
    }
}