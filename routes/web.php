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
})->name('welcome');

Route::resource('/pedidos', 'OrdersController')->middleware('auth');

Route::resource('/clientes', 'ClientsController')->middleware('auth');

Route::resource('/usuario', 'UserController')->middleware('auth');

Route::resource('/preparo', 'PreparingController')->middleware('auth');

Route::resource('/cupons', 'CouponController')->middleware('auth');

Route::resource('/refeicoes', 'menuController')->middleware('auth');

Route::resource('/minhaBandeja', 'TrayController')->middleware('auth');

Route::resource('/itensAdicionais', 'ExtrasController')->middleware('auth');

//Rotas de pedido.

Route::get('/tipoPedido', 'TrayController@orderType')->name('tipoPedido')->middleware('auth');

//Rotas de combo

Route::get('/hamburguer', 'TrayController@orderComboHamburguer')->name('comboHamburguer')->middleware('auth');

Route::get('/acompanhamento/{id}', 'TrayController@fries')->name('acompanhamento')->middleware('auth');

Route::post('/bebida/{id}', 'TrayController@drinks')->name('bebida')->middleware('auth');

Route::post('/salvamento/{id?}', 'TrayController@shoppingFinish')->name('salvamento')->middleware('auth');

Route::get('/finalizarCompra', 'TrayController@reviewAndFinish')->name('fimCompra')->middleware('auth');

Route::post('/removerAdicional', 'TrayController@removeExtras')->name('removeadd')->middleware('auth');

//Rotas de edição do combo.

Route::get('/editarComboAcompanhamento', 'TrayController@editPortion')->name('editarPorcao')->middleware('auth');

Route::get('/editarComboBebida', 'TrayController@editDrink')->name('editarBebida')->middleware('auth');

Route::get('/editarComboExtras/{id?}', 'TrayController@editComboExtras')->name('editarComboExtras')->middleware('auth');

//Rotas de pedido avulso.

Route::get('/cardapio/{insert?}', 'menuController@foodMenu')->name('cardapio')->middleware('auth');

Route::get('/adicionarItem/{id}', 'TrayController@freeOrder')->name('adicionarItem')->middleware('auth');

Route::post('/removerItem/{id}', 'TrayController@detached')->name('removerItem')->middleware('auth');

Route::post('/removerPersonalizado/{id}', 'TrayController@removePersonalized')->name('removerPersonalizado')->middleware('auth');

Route::post('/editarPersonalizado/{id}', 'TrayController@editPersonalized')->name('editarPersonalizado')->middleware('auth');

Route::post('/removeCustomizado/{id}', 'TrayController@removeCustom')->name('removeCustomizado')->middleware('auth');

Route::post('/adicionaExtraComum/{id}', 'TrayController@addExtraItem')->name('addExtraItem')->middleware('auth');

//Rota de aplicação de cupom.

Route::post('/aplicarCupom', 'TrayController@couponApply')->name('aplicarCupom')->middleware('auth');

Route::post('/removerCupom/{couponName}', 'TrayController@couponRemove')->name('removerCupom')->middleware('auth');


//Rotas de alteração de status dos pedidos.
Route::post('/alterarStatus/{id}/{acao}/{remetente}/{idCliente}', 'OrdersController@changeStatus')->name('alterarStatus')->middleware('auth');


//Rotas de gerenciamento.
Route::get('/emPreparo', 'PreparingController@toPrepare')->name('emPreparo')->middleware('auth')->middleware('auth');

Route::get('/meusDados', 'ClientsController@myData')->name('meusDados')->middleware('auth')->middleware('auth');

Route::get('/meusPedidos', 'OrdersController@clientsOrders')->name('meusPedidos')->middleware('auth')->middleware('auth');

Route::get('/gerenciamento', 'UserController@management')->name('gerenciamento')->middleware('auth')->middleware('auth');

Route::get('/financeiro', 'FinancialController@index')->name('financeiro')->middleware('auth');

Route::get('/dashboard', 'FinancialController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/pedidosPendentes', 'OrdersController@pending')->name('pedidosPendentes')->middleware('auth');

Route::get('/deletarPendente/{id}', 'OrdersController@deletePending')->name('deletaPendente')->middleware('auth');

Route::get('/confirmarPendente/{id}', 'OrdersController@confirmPending')->name('confirmaPendente')->middleware('auth');

Route::get('/confirmarPedido', 'OrdersController@confirm')->name('confirmarPedido')->middleware('auth')->middleware('auth');

//Rotas do ACL
Route::resource('/roles', 'RoleController')->middleware('auth');

Route::resource('/permissions', 'PermissionController')->middleware('auth');

Route::get('user/{user}/roles', 'UserController@roles')->name('userRoles')->middleware('auth');

Route::put('user/{user}/roles/sync', 'UserController@rolesSync')->name('userRolesSync')->middleware('auth');

//Rotas de sincronização entre tipo de usuário e permissões.
Route::get('role/{role}/permissions', 'RoleController@permissions')->name('rolePermissions')->middleware('auth');

Route::put('role/{role}/permissions/sync', 'RoleController@permissionsSync')->name('rolePermissionsSync')->middleware('auth');

Route::get('/permissionsList', 'PermissionController@permissions')->name('permissions')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/dados', 'HomeController@getData')->name('dados')->middleware('auth');

//Rotas Ajax

Route::get('/ajaxpreparo', 'HomeController@getPrepare')->name('prepajax');

Route::get('/ajaxcozinha', 'HomeController@getKitchen')->name('cozjax');

Route::get('/historicoPedidos', 'LiveSearch@index')->name('historicoPedidos');

Route::get('/buscaPedidos', 'LiveSearch@action')->name('buscaPedidos');

Route::get('/pedidoCliente', 'PreparingController@clientOrder')->name('pedidoCliente');

Route::get('/teste', 'PreparingController@teste')->name('teste');

