<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('importador', 'ImportControler@epidiImport');
Route::get('/', 'PagesController@home');
//Route::get('/', function () {
//    return redirect()->action('Auth\AuthController@render');
//});
    Route::get('tutorial', 'PagesController@tutorial');

Route::get('/home', 'PagesController@home');
Route::get('/reportes', 'ReportController@index');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');
Route::get('/tickets', 'TicketsController@index');
Route::get('/tickets/{slug?}', 'TicketsController@show');
Route::get('/tickets/{slug?}/edit', 'TicketsController@edit');
Route::post('/tickets/{slug?}/edit', 'TicketsController@update');
Route::post('/tickets/{slug?}/delete', 'TicketsController@destroy');

Route::post('/comment', 'CommentsController@newComment');

//-----------------------Autenticación-----------------------------

//Registracion
Route::get('users/register', 'Auth\AuthController@getRegister');
Route::post('users/register', 'Auth\AuthController@postRegister');

//Logout
Route::get('users/logout', 'Auth\AuthController@getLogout');

//Login
Route::get('users/login', 'Auth\AuthController@getLogin');
Route::post('users/login', 'Auth\AuthController@postLogin');

//Prueba
Route::get('/testvue', 'PagesController@vue');
Route::get('/testvue_suscripcion', 'PagesController@vueSuscription');
Route::get('/testvue_lists', 'PagesController@vueLists');
//API
Route::get('api/estudios/{id_e}', 'Panel\EstudiosController@getCamposByEstudio');
//Fin prueba

//-----------------------Fin Autenticación-----------------------------

//-------Front End Historias Clinicas--------------

Route::group(array('prefix'=>'panel', 'namespace'=>'Panel', 'middleware'=> 'medico'), function () {

    Route::get('/', 'PanelHistoriasController@index');
    Route::get('historial', 'PanelHistoriasController@historial');

    //Crear nueva historia clinica
    Route::get('paciente/crear', 'PanelHistoriasController@create');
    Route::post('paciente/crear', 'PanelHistoriasController@store');

    //Editar historia clinica
    Route::get('paciente/{id?}/editar', 'PanelHistoriasController@edit');
    Route::post('paciente/{id?}/editar', 'PanelHistoriasController@update');

    //Ver historia clinica
    Route::get('paciente/{id?}', 'PanelHistoriasController@verHistoria');

    Route::post('paciente/submitNuevaConsulta', 'PanelHistoriasController@nuevaConsulta');
    Route::get('paciente/{id_p}/nuevaConsulta', 'PanelHistoriasController@showConsulta');
    Route::post('paciente/submitEditarConsulta', 'PanelHistoriasController@guardarConsulta');
    Route::delete('paciente/submitBorrarConsulta', 'PanelHistoriasController@borrarConsulta');
    Route::get('paciente/{id_p?}/consulta/{id_c?}', 'PanelHistoriasController@editarConsulta');

    //Direcciones de paciente
    Route::get('paciente/{id_p?}/direcciones', 'DireccionesController@index');
    Route::post('paciente/{id_p?}/direcciones', 'DireccionesController@store');
    Route::get('paciente/{id_p?}/direcciones/{id_d?}/edit', 'DireccionesController@edit');
    Route::post('paciente/{id_p?}/direcciones/{id_d?}/edit', 'DireccionesController@update');
    Route::get('paciente/{id_p?}/direcciones/{id_d?}/delete', 'DireccionesController@showForDelete');
    Route::post('paciente/{id_p?}/direcciones/{id_d?}/delete', 'DireccionesController@destroy');

    //Teléfonos de paciente
    Route::get('paciente/{id_p?}/telefonos', 'TelefonosController@index');
    Route::post('paciente/{id_p?}/telefonos', 'TelefonosController@store');
    Route::get('paciente/{id_p?}/telefonos/{id_t?}/edit', 'TelefonosController@edit');
    Route::post('paciente/{id_p?}/telefonos/{id_t?}/edit', 'TelefonosController@update');
    Route::get('paciente/{id_p?}/telefonos/{id_t?}/delete', 'TelefonosController@showForDelete');
    Route::post('paciente/{id_p?}/telefonos/{id_t?}/delete', 'TelefonosController@destroy');

    //Epidemiologías
    Route::get('paciente/{id?}/epidemio/editar', 'EpidemiologiaController@edit');
    Route::post('paciente/{id?}/epidemio/editar', 'EpidemiologiaController@update');

    //Tratamientos
    //Alta
    Route::get('paciente/{id_p?}/tratamientos/create', 'TratamientosController@create');
    Route::post('paciente/{id_p?}/tratamientos/create', 'TratamientosController@store');
    //Modificación
    Route::get('paciente/{id_p?}/tratamientos/{id_t?}/edit', 'TratamientosController@edit');
    Route::post('paciente/{id_p?}/tratamientos/{id_t?}/edit', 'TratamientosController@update');
    //Baja
    Route::get('paciente/{id_p?}/tratamientos/{id_t?}/delete', 'TratamientosController@showForDelete');
    Route::post('paciente/{id_p?}/tratamientos/{id_t?}/delete', 'TratamientosController@destroy');
    //Consulta
    Route::get('paciente/{id_p?}/tratamiento/{id_t?}', 'PanelHistoriasController@verTratamiento');
    //Consulta todos
    Route::get('paciente/{id_p?}/tratamientos', 'PanelHistoriasController@verTodosTratamientos');
    //Fin Tratamientos

    //Estudios
    //Alta
    Route::get('paciente/{id_p?}/estudios/create', 'EstudiosController@create');
    Route::post('paciente/{id_p?}/estudios/create', 'EstudiosController@store');
    //Modificación
    Route::get('paciente/{id_p?}/estudios/{id_e?}/edit', 'EstudiosController@edit');
    Route::post('paciente/{id_p?}/estudios/{id_e?}/edit', 'EstudiosController@update');
    //Baja
    Route::get('paciente/{id_p?}/estudios/{id_e?}/delete', 'EstudiosController@showForDelete');
    Route::post('paciente/{id_p?}/estudios/{id_e?}/delete', 'EstudiosController@destroy');
    //Consulta
    Route::get('paciente/{id_p?}/estudio/{id_e?}', 'PanelHistoriasController@verEstudio');
    //Consulta todos
    Route::get('paciente/{id_p?}/estudios', 'PanelHistoriasController@verTodosEstudios');

    // Fin Estudios
    //Route::get('ajax/estudio/{id}', 'EstudiosController@getEstudioJson');
    Route::get('ajax/hhcc', 'PanelHistoriasController@getHCJson');
    Route::post('ajax/uploadfile', 'PanelHistoriasController@uploadFile');
}); 

//-------Fin Front End Historias Clinicas--------------


Route::group(array('prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=> 'manager'), function () {
    //Admin dashboard
    Route::get('/', 'PagesController@home');
    //ver usuarios 
    Route::get('users', 'UsersController@index');
    //administrar roles
    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/create', 'RolesController@store');
    //asignar roles a usuarios
    Route::get('users/{id?}/edit', 'UsersController@edit');
    Route::post('users/{id?}/edit', 'UsersController@update');
    //administrar posts
    Route::get('posts', 'PostsController@index');
    Route::get('posts/create', 'PostsController@create');
    Route::post('posts/create', 'PostsController@store');
    Route::get('posts/{id?}/edit', 'PostsController@edit');
    Route::post('posts/{id?}/edit', 'PostsController@update');
    //Administrar categorias
    Route::get('categories', 'CategoriesController@index');
    Route::get('categories/create', 'CategoriesController@create');
    Route::post('categories/create', 'CategoriesController@store');
    //Administrar sedes
    Route::get('sedes', 'SedesController@index');
    //Route::delete('sedes', 'SedesController@destroy');
    Route::get('sedes/create', 'SedesController@create');
    Route::post('sedes/create', 'SedesController@store');
    Route::get('sedes/{id?}/edit', 'SedesController@edit');
    Route::get('sedes/{id?}/show', 'SedesController@show');
    Route::get('sedes/{id?}/delete', 'SedesController@destroy');
    Route::post('sedes/{id?}/edit', 'SedesController@update');

    //Administrar sintomas
    Route::get('sintomas', 'SintomasController@index');
    Route::get('sintomas/create', 'SintomasController@create');
    Route::post('sintomas/create', 'SintomasController@store');
    Route::get('sintomas/{id?}/edit', 'SintomasController@edit');
    Route::post('sintomas/{id?}/edit', 'SintomasController@update');
    Route::get('sintomas/{id?}/show', 'SintomasController@show');
    Route::get('sintomas/{id?}/delete', 'SintomasController@destroy');

    //Administrar patologias
    Route::get('patologias', 'PatologiasController@index');
    Route::get('patologias/create', 'PatologiasController@create');
    Route::post('patologias/create', 'PatologiasController@store');
    Route::get('patologias/{id?}/edit', 'PatologiasController@edit');
    Route::post('patologias/{id?}/edit', 'PatologiasController@update');
    Route::get('patologias/{id?}/delete', 'PatologiasController@show');
    Route::post('patologias/{id?}/delete', 'PatologiasController@destroy');

    //items historia clinica
    Route::get('items', 'HistoriasClinicasController@index');
    Route::get('items/create', 'HistoriasClinicasController@create');
    Route::post('items/create', 'HistoriasClinicasController@store');
    Route::get('items/{id?}/edit', 'HistoriasClinicasController@edit');
    Route::post('items/{id?}/edit', 'HistoriasClinicasController@update');
    Route::post('items/{id?}/delete', 'HistoriasClinicasController@destroy');
    Route::post('items/{id?}/show', 'HistoriasClinicasController@show');

    Route::post('items/{id?}/getHistorias', 'HistoriasClinicasController@getPacientesByMedico');

    //Campos Base
    Route::get('estudios/camposbase', 'CamposBaseController@index');
    Route::get('estudios/camposbase/create', 'CamposBaseController@create');
    Route::post('estudios/camposbase/create', 'CamposBaseController@store');
    Route::get('estudios/camposbase/{id?}/edit', 'CamposBaseController@edit');
    Route::post('estudios/camposbase/{id?}/edit', 'CamposBaseController@update');
    Route::post('estudios/camposbase/getAllCamposBase', 'CamposBaseController@getAllCamposBase');

    //Unidades de Medida
    Route::get('estudios/unidadesmedida', 'UnidadesMedidaController@index');
    Route::get('estudios/unidadesmedida/create', 'UnidadesMedidaController@create');
    Route::post('estudios/unidadesmedida/create', 'UnidadesMedidaController@store');
    Route::get('estudios/unidadesmedida/{id?}/edit', 'UnidadesMedidaController@edit');
    Route::post('estudios/unidadesmedida/{id?}/edit', 'UnidadesMedidaController@update');

    //Medicamentos
    Route::get('medicamentos', 'MedicamentosController@index');
    Route::get('medicamentos/create', 'MedicamentosController@create');
    Route::post('medicamentos/create', 'MedicamentosController@store');

    //Estudios
    Route::get('estudios', 'EstudiosController@index');
    Route::get('estudios/create', 'EstudiosController@create');
    Route::post('estudios/create', 'EstudiosController@store');
    Route::get('estudios/{id?}/show', 'EstudiosController@show');
    Route::get('estudios/{id?}/edit', 'EstudiosController@edit');
    Route::post('estudios/{id?}/edit', 'EstudiosController@update');
    Route::post('estudios/{id?}/delete', 'EstudiosController@destroy');

    //Tratamientos
    Route::get('tratamientos', 'TratamientosController@index');
    Route::get('tratamientos/create', 'TratamientosController@create');
    Route::post('tratamientos/create', 'TratamientosController@store');
    Route::get('tratamientos/{id?}/show', 'TratamientosController@show');
    Route::get('tratamientos/{id?}/edit', 'TratamientosController@edit');
    Route::post('tratamientos/{id?}/edit', 'TratamientosController@update');
    Route::post('tratamientos/{id?}/delete', 'TratamientosController@destroy');

    //Historial


});
