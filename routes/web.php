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
    return view('welcome');
});

Route::resource('/pedidos', 'OrdersController');

Route::resource('/clientes', 'ClientsController');

Route::resource('/usuario', 'UserController');

Route::resource('/preparo', 'PreparingController');

Route::resource('/cupons', 'CouponController');

Route::resource('/refeicoes', 'menuController');

Route::resource('/minhaBandeja', 'TrayController');

Route::resource('/itensAdicionais', 'ExtrasController');

//Rotas de pedido.

Route::get('/tipoPedido', 'TrayController@orderType')->name('tipoPedido');

//Rotas de combo

Route::get('/hamburguer', 'TrayController@orderComboHamburguer')->name('comboHamburguer');

Route::get('/acompanhamento/{id}', 'TrayController@fries')->name('acompanhamento');

Route::post('/bebida/{id}', 'TrayController@drinks')->name('bebida');

Route::post('/salvamento/{id?}', 'TrayController@shoppingFinish')->name('salvamento');

Route::get('/finalizarCompra', 'TrayController@reviewAndFinish')->name('fimCompra');

Route::post('/removerAdicional', 'TrayController@removeExtras')->name('removeadd');

//Rotas de edição do combo.

Route::get('/editarComboAcompanhamento', 'TrayController@editPortion')->name('editarPorcao');

Route::get('/editarComboBebida', 'TrayController@editDrink')->name('editarBebida');

//Rotas de pedido avulso.

Route::get('/cardapio/{insert?}', 'menuController@foodMenu')->name('cardapio');

Route::get('/adicionarItem/{id}', 'TrayController@freeOrder')->name('adicionarItem');

Route::post('/removerItem/{id}', 'TrayController@detached')->name('removerItem');

Route::post('/removerPersonalizado/{id}', 'TrayController@removePersonalized')->name('removerPersonalizado');

Route::post('/editarPersonalizado/{id}', 'TrayController@editPersonalized')->name('editarPersonalizado');

//Rota de aplicação de cupom.

Route::post('/aplicarCupom', 'TrayController@couponApply')->name('aplicarCupom');

Route::post('/removerCupom/{couponName}', 'TrayController@couponRemove')->name('removerCupom');


//Rotas de alteração de status dos pedidos.
Route::post('/alterarStatus/{id}/{acao}', 'OrdersController@changeStatus')->name('alterarStatus');


//Rotas de gerenciamento.
Route::get('/emPreparo', 'PreparingController@toPrepare')->name('emPreparo');

Route::get('/meusDados', 'ClientsController@myData')->name('meusDados');

Route::get('/meusPedidos', 'OrdersController@clientsOrders')->name('meusPedidos');

Route::get('/gerenciamento', 'UserController@management')->name('gerenciamento');

Route::get('/financeiro', 'FinancialController@index')->name('financeiro');

Route::get('/dashboard', 'FinancialController@dashboard')->name('dashboard');

Route::get('/pedidosPendentes', 'OrdersController@pending')->name('pedidosPendentes');

Route::get('/confirmarPedido', 'OrdersController@confirm')->name('confirmarPedido');

//Rotas do ACL
Route::resource('/roles', 'RoleController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dados', 'HomeController@getData')->name('dados');

//Rotas Ajax

Route::get('/ajaxpreparo', 'HomeController@getPrepare')->name('prepajax');

Route::get('/ajaxcozinha', 'HomeController@getKitchen')->name('cozjax');

Route::get('/historicoPedidos', 'LiveSearch@index')->name('historicoPedidos');

Route::get('/buscaPedidos', 'LiveSearch@action')->name('buscaPedidos');

Route::get('/pedidoCliente', 'PreparingController@clientOrder')->name('pedidoCliente');

Route::get('/teste', 'PreparingController@teste')->name('teste');

