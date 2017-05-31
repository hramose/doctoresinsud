@extends('master')
@section('title', 'All posts')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Todos los items </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($items_hc->isEmpty())
                <p> No hay items cargados.</p>
            @else
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Titulo</th>
                        <th>fecha</th>


                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items_hc as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <a href="{!! action('Admin\HistoriasClinicasController@edit', $item->id) !!}">{!! $item->title !!} </a>
                            </td>
                            <td>{{ $item->created_at }}</td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection