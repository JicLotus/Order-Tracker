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

Route::get('pedidos', "PedidosController@index");

Route::get('agendas', "AgendasController@index");
Route::get('agregaragenda', "NuevaAgendaController@index");
Route::post('guardarnuevaagenda', "NuevaAgendaController@guardar");


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
