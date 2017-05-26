@extends('master')
@section('name', 'Edit a user')

@section('content')

<h3 class="page-title">Tutoriales</b>  </h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ URL::to('/') }}/">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
         
        <li>
            <a href="#">Tutoriales</a>
          </li>
    </ul>
</div>



   <div class="portlet box grey-cascade"  >
        <div class="portlet-title">

             <div class="actions btn-set">
                <a href="{!! action('Admin\UsersController@index') !!}" type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Atras</a>
            </div>

        </div>
        <div class="portlet-body">
            <div style="border-bottom:solid #4f81bd 1.0pt; padding:0cm 0cm 4.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:26pt"><span style="font-family:Cambria,serif"><span style="color:#17365d">M&oacute;dulos Administrativos </span></span></span></p>
</div>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Adm&oacute;n. Campos Base</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Este m&oacute;dulo contiene tres vistas&nbsp; listado de campos base, creaci&oacute;n&nbsp; y edici&oacute;n, en estas dos &uacute;ltimas se puede seleccionar&nbsp; que tipo de campo se requiere &ldquo;decimal,&nbsp; entero,&nbsp; texto, falso y verdadero&rdquo;, tambi&eacute;n la unidad de medida, el valor m&iacute;nimo y el m&aacute;ximo, Estos campos base van a alimentar los campos de estudio en el m&oacute;dulo de Estudios</span></span></p>

<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 


<video width=700 height="440" controls>
  <source src="http://chagas.mundosano.org/doctores/web/public/videos/admin/1-%20Admin%20Campos%20Base.mp4" type="video/mp4">
 Your browser does not support the video tag.
</video>

</p>

<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Adm&oacute;n. Medicamentos</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Se pueden crear&nbsp; y listar los medicamentos con el nombre respectivo, estos valores van a alimentar las opciones de la historia cl&iacute;nica.</span></span></p>

 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/admin/2-%20Admin%20medicamento.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>
<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Adm&oacute;n. Unidad de medida</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Se pueden crear&nbsp; y listar las unidades de medida con el nombre respectivo, estos valores van a alimentar las opciones en los campos&nbsp; base</span></span></p>

 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/admin/3-%20Admin%20Unidad%20medida.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>
<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Adm&oacute;n. De Estudios</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Se pueden crear, editar&nbsp; y listar los estudios &nbsp;y vincular uno o m&aacute;s campos base as&iacute; como la descripci&oacute;n y nombre, estos valores van a alimentar las opciones en los campos&nbsp; base</span></span></p>

 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/admin/4-%20Admin%20Estudios.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>

<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Adm&oacute;n. De sindromas</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Se pueden crear, editar&nbsp; y listar los s&iacute;ntomas, habilitar y deshabilitar&nbsp; estos s&iacute;ntomas alimentan las opciones a historias cl&iacute;nicas</span></span></p>

 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/admin/5-%20Admin%20SIntomas.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>



<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Adm&oacute;n. De Patolog&iacute;as</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Se pueden crear, editar&nbsp; y listar los patolog&iacute;as, habilitar y deshabilitar&nbsp; estos s&iacute;ntomas alimentan las opciones a historias cl&iacute;nicas</span></span></p>

 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/admin/6-%20Admin%20Patologias.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>


<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<div style="border-bottom:solid #4f81bd 1.0pt; padding:0cm 0cm 4.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:26pt"><span style="font-family:Cambria,serif"><span style="color:#17365d">Historia cl&iacute;nica </span></span></span></p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Creaci&oacute;n de historia cl&iacute;nica</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">En este m&oacute;dulo se hace la primera carga de la informaci&oacute;n&nbsp; de la historia cl&iacute;nica agregando diferentes tratamientos y alguna informaci&oacute;n del paciente </span></span></p>



<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/historiaclinica/1-%20Creacion%20historia%20clinica.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>

 

<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Vista historia cl&iacute;nica</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">En esta vista se pueden ver los datos junto con los tratamientos , estudios y consultas del usuario, tiene la caracter&iacute;stica de poder ver el historial de cada modificaci&oacute;n de los campos para poder hacer un seguimiento hist&oacute;rico, desde la vista se pueden crear y ver nuevas consultas.</span></span></p>
 

<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/historiaclinica/2-%20Vista%20historia%20clinica.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>

<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Edici&oacute;n de historia cl&iacute;nica</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">En este m&oacute;dulo se hace la primera carga de la informaci&oacute;n&nbsp; de la historia cl&iacute;nica agregando diferentes tratamientos y alguna informaci&oacute;n del paciente </span></span></p>


<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/historiaclinica/3-%20Edicion%20historia%20clinica.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>


<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Edici&oacute;n Epidemiologia</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">En este m&oacute;dulo se modifica y se visualiza los datos del paciente tanto personales como familiares </span></span></p>

 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/historiaclinica/4-%20Epidemiologia%20Edicion.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>


<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Creaci&oacute;n y edici&oacute;n tel&eacute;fonos historia cl&iacute;nica</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Al oprimir el bot&oacute;n de tel&eacute;fonos se puede ver el listado de tel&eacute;fonos y as&iacute; mismo se puede crear.</span></span></p>

 

<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/historiaclinica/5-%20Creacion%20y%20edicion%20telefonos%20historia%20clinica.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>



<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Creaci&oacute;n y edici&oacute;n direcci&oacute;n historia cl&iacute;nica</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Al oprimir el bot&oacute;n de direcci&oacute;n se puede ver el listado de direcciones y as&iacute; mismo se puede crear.</span></span></p>

 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/historiaclinica/6-%20Creacion%20y%20edicion%20direcciones%20historia%20clinica.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>



<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">&nbsp;Creaci&oacute;n y edici&oacute;n tratamientos</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Esta secci&oacute;n se&nbsp; tiene dos botones y un listado, al oprimir en el&nbsp; primer bot&oacute;n de agregar nuevo tratamiento&nbsp; se abre una nueva ventana donde se puede agregar un nuevo tratamiento, y al oprimir en el de ver tratamientos se pueden ver el listado y la edici&oacute;n de los tratamientos.</span></span></p>

 
 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/historiaclinica/6-%20Creacion%20y%20edicion%20tratamientos.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>




<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Creaci&oacute;n y edici&oacute;n Estudios</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Esta secci&oacute;n se&nbsp; tiene dos botones y un listado, al oprimir en el&nbsp; primer bot&oacute;n de agregar nuevo estudio&nbsp;&nbsp; se abre una nueva ventana donde se puede agregar un nuevo estudio, y al oprimir en el de ver estudios se pueden ver el listado y la edici&oacute;n de los Estudios.</span></span></p>

 

 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/historiaclinica/7-%20Creacion%20y%20edicion%20Estudios%20historia%20clinica.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>



<div style="border-bottom:solid windowtext 1.0pt; padding:0cm 0cm 1.0pt 0cm">
<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>
</div>

<p style="margin-left:0cm; margin-right:0cm">&nbsp;</p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Creaci&oacute;n y edici&oacute;n consultas historia cl&iacute;nica</span></span></p>

<p style="margin-left:0cm; margin-right:0cm"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif">Esta secci&oacute;n se puede crear editar borrar y listar consultas, al oprimir el bot&oacute;n superior derecha de nueva consulta se abre una ventana con un formulario divido en tabs o secciones en donde se puede ingresar los diferentes datos de la consulta. </span></span></p>
 
<p style="margin-left:0cm; margin-right:0cm;text-align: center;"> 
    <video width=700 height="440" controls>
      <source src="http://chagas.mundosano.org/doctores/web/public/videos/historiaclinica/8-%20Creacion%20y%20edicion%20consultas%20historia%20clinica.mp4" type="video/mp4">
     Your browser does not support the video tag.
    </video>
</p>



        </div>
    </div>
@endsection