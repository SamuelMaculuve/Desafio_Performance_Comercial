<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});
Route::get('/none', function () {
    return view('pagina_none');
})->name('none');

Route::get('con_desempenho_sub', 'ConsultorController@con_desempenho_sub')->name('con_desempenho_sub');

Route::get('con_desempenho', 'ConsultorController@con_desempenho')->name('con_desempenho');

Route::get('con_desempenho_cliente', 'rel_clientesClienteController@con_desempenho')->name('cliente');

Route::get('consultores', 'ConsultorController@getClientes');

Route::get('get_rel_clientes', 'ConsultorController@get_rel_clientes');

Route::get('consultor_graf', 'ConsultorController@consultor_graf');

Route::get('consultor_pizza', 'ConsultorController@consultor_pizza');

//

Route::get('listar_clientes', 'ClienteController@listar_clientes')->name('cliente');
Route::get('pizza_client', 'ClienteController@dados_pizza')->name('pizza_client');
Route::get('graf_client', 'ClienteController@dados_grafico')->name('graf_client');
Route::get('rel_clientes', 'ClienteController@relatorio');

