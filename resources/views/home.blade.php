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

                <h1 class="text-center margin-top-100 editContent">
                    ¡Ambiente de desarrollo!
                </h1>

                @if( !Auth::guest() )
                    @include('reportes.tablas-home')
                @endif

            </div>

        </div>
    </div>

@endsection
