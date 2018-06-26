@extends('master')

@include('shared.estilos')

@section('title', 'Panel de Historias Clínicas')

@section('content')

<h3 class="page-title">Importador de <b>Estudios</b></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ URL::to('/') }}/">Home</a>
            <i class="fa fa-angle-right"></i>
    </ul>
</div>
<div class="container">
	<div class="container-fluid">
		<div class="panel panel-deafult">
			<div class="panel-heading">
				<h1>Importer</h1>
			</div>
			<div class="panel-body">
                            <form action="{{ route('importer.proccess') }}" method="POST"  enctype="multipart/form-data">
                                      <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <div class="form-group">
                                        <select name="type" id="" class="form-control">
                                                <option value="0">PEG</option>
                                                <option value="1">ECO</option>
                                                <option value="2">LAB</option>
                                                <option value="3">TRAT</option>
                                                <option value="4">EPIDIOM</option>
                                        </select>
                                    <br>
                                        <input type="file" name="file">
                                </div>
				
			</div>
			<div class="panel-footer">
                            <button type="submit" class="btn btn-primary" rol="submit">Enviar</button>
			</div>
                        </form>
		</div>	
	</div>
</div>
@endsection
