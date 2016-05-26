<?php

include app_path() . "/ioc.php";
use \Input as Input;
use \Session as Session;

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


Route::get('/', "HomeController@index");
Route::get('help', "HelpController@index");

Route::get('productos', "ProductosController@index");
Route::get('agregarproducto', "NuevoProductoController@index");
Route::post('guardarnuevoproducto', "NuevoProductoController@guardar");
Route::get('editarproducto/{id}', "EditarProductoController@index");
Route::post('editarproducto/guardarproducto', "GuardarProductoController@index");

Route::get('clientes', "ClientesController@index");
Route::get('agregarcliente', "NuevoClienteController@index");
Route::post('guardarcliente', "NuevoClienteController@guardar");
Route::get('editarcliente/{id}', "EditarClienteController@index");
Route::post('editarcliente/guardarcliente', "GuardarClienteController@index");

Route::get('usuarios', "UsuariosController@index");
Route::get('agregarusuario', "NuevoUsuarioController@index");
Route::post('guardarusuario', "NuevoUsuarioController@guardar");
Route::get('editarusuario/{id}', "EditarUsuarioController@index");
Route::post('editarusuario/guardarusuario', "GuardarUsuarioController@index");

Route::get('pedidos', "PedidosController@index");
Route::get('pedidovendedor', "PedidoVendedorController@index");
Route::get('editarpedido/{id}', "EditarPedidoController@index");
Route::get('eliminarpedidoscancelados', "EliminarPedidosCanceladosController@index");

Route::get('agenda', "AgendaController@index");
Route::get('agendas', "AgendasController@index");
Route::get('agregaragenda', "NuevaAgendaController@index");
Route::post('guardarnuevaagenda', "NuevaAgendaController@guardar");
Route::get('asignarhorarios/{id}', "AsignarHorariosController@index");
Route::get('eliminaragenda/{idAgenda}/{vendedor}', "EliminarAgendaController@index");

Route::get('descuentos', "DescuentosController@index");
Route::post('descuentosFiltro', "DescuentosController@filtro");
Route::get('borrarDescuentosVencidos', "DescuentosController@borrarDescuentosVencidos");

Route::get('agregarnuevodescuento', "NuevoDescuentoController@index");
Route::post('guardarnuevodescuento', "NuevoDescuentoController@guardar");

Route::get('estadisticas', "EstadisticasController@index");
Route::post('estadisticasFiltro', "EstadisticasController@filtrar");

Route::group(array('middleware' => 'auth'), function() {

  Route::post('/login-as', function(){
      if (app()->make('loggedUser')->id == Input::get('id')){
        Session::forget("loginAs");
      }
      else {
        Session::put("loginAs", Input::get('id'));
      }
      return redirect(Input::get('back'));
  });
});
