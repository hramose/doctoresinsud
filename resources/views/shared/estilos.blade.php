@section('estilos')

<style type="text/css">
	html, body {
		max-width: 100%;
		overflow-x: hidden;
	}

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
	textarea {
		/*max-width: 100%;*/
		resize: none;
	}

/*	#pbody-trat {
		width: 100%;
	}

	#modal-tratamientos {
		width: 100%;
	}*/

	.vcenter {
		vertical-align: middle;
		position: relative; top: 5px;
	}

</style>

@endsection