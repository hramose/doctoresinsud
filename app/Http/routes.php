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

Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');
Route::get('/tickets','TicketsController@index');
Route::get('/tickets/{slug?}', 'TicketsController@show');
Route::get('/tickets/{slug?}/edit', 'TicketsController@edit');
Route::post('/tickets/{slug?}/edit', 'TicketsController@update');
Route::post('/tickets/{slug?}/delete', 'TicketsController@destroy');
// Route::get('sendmail', function (){
// 	$data = array('name' => "Learning Laravel",);

// 	Mail::send('emails.welcome', $data, function($message){

// 		$message->from('alejandro_abraham@tickets.com', 'Learning Laravel');
// 		$message->to('alejandro_abraham@me.com')->subject('Learning Laravel test email');
// 	});
// 	return "Your email has been sent succesfully";
// });
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

//-----------------------Fin Autenticación-----------------------------

Route::group(array('prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=> 'manager'), function(){
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
	Route::post('users/{id?}/edit','UsersController@update');
	//administrar posts
	Route::get('posts', 'PostsController@index');
	Route::get('posts/create', 'PostsController@create');
	Route::post('posts/create', 'PostsController@store');
	Route::get('posts/{id?}/edit', 'PostsController@edit');
	Route::post('posts/{id?}/edit','PostsController@update');
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

	//pacientes
	Route::get('pacientes', 'PacientesController@index');
	Route::get('pacientes/create', 'PacientesController@create');
	Route::post('pacientes/create', 'PacientesController@store');
	Route::get('pacientes/{id?}/edit', 'PacientesController@edit');
	Route::post('pacientes/{id?}/edit', 'PacientesController@update');
	Route::get('pacientes/{id?}/show', 'PacientesController@show');

	//items historia clinica
	Route::get('items', 'HistoriasClinicasController@index');
	Route::get('items/create', 'HistoriasClinicasController@create');
	Route::post('items/create', 'HistoriasClinicasController@store');
	Route::get('items/{id?}/edit', 'HistoriasClinicasController@edit');
	Route::post('items/{id?}/edit', 'HistoriasClinicasController@update');
	Route::post('items/{id?}/delete', 'HistoriasClinicasController@destroy');
	Route::post('items/{id?}/show', 'HistoriasClinicasController@show');

	Route::post('items/{id?}/getHistorias','HistoriasClinicasController@getPacientesByMedico');

	//Campos Base
	Route::get('estudios/camposbase', 'CamposBaseController@index');
    Route::get('estudios/camposbase/create', 'CamposBaseController@create');
    Route::post('estudios/camposbase/create', 'CamposBaseController@store');
    Route::get('estudios/camposbase/{id?}/edit', 'CamposBaseController@edit');
	Route::post('estudios/camposbase/{id?}/edit','CamposBaseController@update');
	Route::post('estudios/camposbase/getAllCamposBase','CamposBaseController@getAllCamposBase');

	//Unidades de Medida
	Route::get('estudios/unidadesmedida', 'UnidadesMedidaController@index');
    Route::get('estudios/unidadesmedida/create', 'UnidadesMedidaController@create');
    Route::post('estudios/unidadesmedida/create', 'UnidadesMedidaController@store');
    Route::get('estudios/unidadesmedida/{id?}/edit', 'UnidadesMedidaController@edit');
	Route::post('estudios/unidadesmedida/{id?}/edit','UnidadesMedidaController@update');

	//Medicamentos
	Route::get('medicamentos', 'MedicamentosController@index');
	Route::get('medicamentos/create', 'MedicamentosController@create');
	Route::post('medicamentos/create','MedicamentosController@store');

	//Estudios
	Route::get('estudios', 'EstudiosController@index');
	Route::get('estudios/create', 'EstudiosController@create');
	Route::post('estudios/create', 'EstudiosController@store');
	Route::get('estudios/{id?}/show','EstudiosController@show');
	Route::get('estudios/{id?}/edit','EstudiosController@edit');
	Route::post('estudios/{id?}/edit','EstudiosController@update');
	Route::post('estudios/{id?}/delete','EstudiosController@destroy');

	//Estudios
	Route::get('tratamientos', 'TratamientosController@index');
	Route::get('tratamientos/create', 'TratamientosController@create');
	Route::post('tratamientos/create', 'TratamientosController@store');
	Route::get('tratamientos/{id?}/show','TratamientosController@show');
	Route::get('tratamientos/{id?}/edit','TratamientosController@edit');
	Route::post('tratamientos/{id?}/edit','TratamientosController@update');
	Route::post('tratamientos/{id?}/delete','TratamientosController@destroy');


	Route::get('/estudios/camposbase1', 'CamposBaseAppController@index');
	Route::post('/estudios/camposbase1', 'CamposBaseAppController@store');
	
});

Route::resource('api/camposbase', 'Admin\CamposBaseAjaxController');

//Route::resource('api/camposbase1', 'Admin\CamposBaseAppController');




/*
Route::get('/blog', 'BlogController@index');
Route::get('/blog/{slug?}', 'BlogController@show');

Route::get('autocomplete', function()
{

    return View::make('autocomplete');
});

Route::get('/campos/{text?}', 'Admin\CamposBaseController@busqueda');
*/