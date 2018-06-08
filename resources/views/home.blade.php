@extends('master')
@section('title', 'Home')

@include('shared.estilos')

@section('content')

    {{--    <div class="header">
            <h2>Panel de Historias Clínicas</h2>
        </div>--}}

    <div class="container">
        <div class="row banner">

            <div class="col-lg-12">
                @if(!Auth::check())
                <h1 class="text-center margin-top-100 editContent">
                   Ambiente de desarrollo
                </h1>
                <hr>
                <div class="text-center">
                    <span class="lead">Bienvenido a la plataforma de carga y muestra de historias clinicas para la enfermedad de chagas.</span>
                </div>
                <hr>
                @endif
                @if( !Auth::guest())
                <h1 class="text-center margin-top-100 editContent"> Inicio</h1>
                <hr>
                @include('reportes.tablas-home') 
                @endif
                

            </div>

        </div>
    </div>

@endsection
