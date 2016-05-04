@section('estilos')

<style type="text/css">
	.aa-header{
		background-color: #009688;
		margin: 0 !important;
	}

	#detalles {
		display: none;
		padding : 5px;
	}

	#expand-boton {
		margin-left:50%;
		position: relative;
		bottom: -38px;
	}

	#pbody-consultas, #pbody-estudios, #pbody-trat {
		height: 500px;
		overflow-y: auto;
	}

	.col-centered{
		display: block;
		margin-left: auto;
		margin-right: auto;
		text-align: center;
	}
	.ui-autocomplete {
		max-height: 100px;
		overflow-y: auto;
		/* prevent horizontal scrollbar */
		overflow-x: hidden;
	}

</style>

@endsection