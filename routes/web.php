<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

/*
Route::get('', '');
Route::get('/', function () {
    return view('welcome');
});

Route::get('exportar-bdd', function(){
  dd(phpinfo());
  $db_host = '127.0.0.1'; //Host del Servidor MySQL
  $db_name = 'infocentro'; //Nombre de la Base de datos
  $db_user = 'root'; //Usuario de MySQL
  $db_pass = ''; //Password de Usuario MySQL
  
  $fecha = date("Ymd-His"); //Obtenemos la fecha y hora para identificar el respaldo
 
  // Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
  $salida_sql = $db_name.'_'.$fecha.'.sql'; 
  
  //Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
  $dump = "mysqldump --h$db_host -u$db_user -p --opt $db_name > $salida_sql";
  system($dump, $output); //Ejecutamos el comando para respaldo
});

Route::get('email', function () {
    return view('auth.email');
});
*/

//view Resetear Password
Route::get('reset', function(){return view('auth.reset');});
//Resetear Password / Pregunta de Seguridad
Route::get('verificar-email/{email}', 'UserController@verificar_email');
Route::post('procesar-pregunta-seguridad','UserController@pregunta_seguridad');
Route::post('actualizar-password', 'UserController@actualizar_password');
//Resetear Password / Email
Route::get('recuperar-contrasena-via-email/{email}', 'UserController@ResetPasViaEmail');

Route::group(['prefix' => '', 'middleware' => ['auth', 'habilitado']], function(){

  //Home
  Route::get('/', 'HomeController@index');

  //Personal
  Route::resource('personal', 'Personalcontroller');
  Route::get('{id}/destroy', ['uses' => 'Personalcontroller@destroy','as' => 'personal.destroy']);
  Route::get('{id}/Ficha-Personal', ['uses' => 'Personalcontroller@ficha_personal', 'as' => 'Ficha-Personal']);

  //usuarios beneficiados al infocentro - recuerda que hay routes que son las mismas, ya que estamos usando el mismo controller
  Route::resource('usuario', 'UsuarioController');
  Route::get('{id}/destroy/usuario', ['uses' => 'UsuarioController@destroy','as' => 'usuario.destroy']);
  Route::get('{id}/Ficha-usuario', ['uses' => 'UsuarioController@ficha_personal','as' => 'Ficha-usuario']);

  //Equipo
  Route::resource('equipo', 'EquipoController');
  Route::get('{id}/habilitar-equipo', 'EquipoController@habilitar');
  Route::get('{id}/inhabilitar-equipo', 'EquipoController@inhabilitar');
  Route::get('equipo-control', 'EquipoController@control');
  Route::post('AsignarEquipo', ['uses' => 'EquipoController@AsignarEquipo', 'as' => 'AsignarEquipo']);
  Route::get('{id_cm}/{id_e}/FinalizarEquipo', 'EquipoController@FinalizarEquipo');
  Route::get('{id}/ficha-equipo', ['uses' => 'EquipoController@ficha_equipo', 'as' => 'ficha_equipo']);

  //Componentes
  Route::resource('componente', 'ComponenteController');
  Route::get('componente-detalle/{id}', 'ComponenteController@detalle');
  Route::post('cambiar-estatus', ['uses' => 'ComponenteController@cambiar_estatus', 'as' => 'cambiar-estatus']);

  //MODULO ACTIVIDAD
  Route::resource('actividad', 'ActividadController');
  Route::post('AsignarActividad', ['uses' => 'ActividadController@AsignarActividad','as' => 'AsignarActividad']);
  Route::get('{actividad_id}/{miembro_id}/eliminar-miembro-actividad', 'ActividadController@EliminarMiembro');
  Route::get('{id}/destroy/actividad', ['uses' => 'ActividadController@destroy','as' => 'actividad.destroy']);
  Route::get('actividades-realizadas', 'ActividadController@ActividadRealizada');
  Route::get('{id}/ficha-actividad', ['uses' => 'ActividadController@ficha_actividad','as' => 'ficha_actividad']);

  //Reportes
    //Usuario Personal
    Route::get('reporte-usuario-personal', function(){return view('reporte.usu_per');});
    Route::get('cedula-reporte-usuario-personal/{cedula}','ReporteController@Usu_Per_Cedula');
    Route::post('avazado-reporte-usuario-personal', 'ReporteController@Usu_Per_Avanzado');
    //Equipo
    Route::get('reporte-equipo', function(){return view('reporte.equipo', ['equipo' => Infocentro\Equipo::pluck('numero', 'id')]);});
    Route::post('reporte-equipo-pdf','ReporteController@reporte_equipo');
    //Usuarios - sistema
    Route::get('reporte-usuarios-sistema', 'ReporteController@list_user');
    //Componentes
    Route::get('reporte-componente', 'ReporteController@view_componente');
    Route::get('jquery-autocomplete', 'ReporteController@jquery_autocomplete_comp');
    Route::post('reporte-componente-pdf', 'ReporteController@rep_comp');
    //Red-Social
    Route::get('red-social-pdf', 'ReporteController@red_social');
    //Periferico
    Route::get('periferico-pdf', 'ReporteController@periferico');
    //Cintillo
    Route::get('cintillo-pdf', 'ReporteController@cintillo');

  //users
  Route::post('perfil', ['uses' => 'UserController@perfil', 'as' => 'perfil']);
  Route::resource('user', 'UserController', ['only' => ['edit', 'update']]);
  Route::get('darme-de-baja/{id}', ['uses' => 'UserController@DarmeDeBaja', 'as' => 'darme-de-baja']);
  
  //Esta route es auxiliar para redireccionar en ajax / la otra de arriba es post
  Route::get('perfil', ['uses' => 'UserController@perfil', 'as' => 'perfil']);

  Route::group(['prefix' => '', 'middleware' => 'admin'], function(){
    //users
    Route::resource('user', 'UserController', ['only' => 'index']);
    Route::get('accion-user/{id}/{accion}', ['uses' => 'UserController@accion', 'as' => 'accion-user']);
    
     //Red Social
    Route::resource('red-social', 'RedSocialController');
    Route::get('{id}/eliminar-red-social', ['uses' => 'RedSocialController@destroy','as' => 'eliminar-red-social']);

    //perifericos
    Route::resource('perifericos', 'PerifericoController');
    Route::get('{id}/eliminar',['uses' => 'PerifericoController@destroy', 'as' => 'periferico.destroy']);

    //cintillo
    Route::resource('institucion', 'InstitucionController');
  });
 
});

//login
Auth::routes();
Route::get('/home', 'HomeController@index');
