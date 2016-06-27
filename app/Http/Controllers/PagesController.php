<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    //Controlador de paginas del sitio

    public function home()
    {

        //test 
        
    	return view('home');
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