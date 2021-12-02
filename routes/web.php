<?php

use Illuminate\Support\Facades\DB;
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

    $foods = \App\Adverts::where('foodType', 'Pizza')->get();
    $drinks = \App\Adverts::where('foodType', 'Bebida')->get();
    $foods2 = \App\Adverts::all();

    return view('welcome', compact('foods', 'drinks', 'foods2'));
})->name('welcome');

Route::get('/cardapio', function () {

    return redirect()->route('welcome');

})->name('cardapioRedirect');

Route::resource('/pedidos', 'OrdersController')->middleware('auth');

Route::resource('/clientes', 'ClientsController')->middleware('auth');

Route::resource('/usuario', 'UserController')->middleware('auth');

    Route::resource('/preparo', 'PreparingController')->middleware('auth');

Route::resource('/cupons', 'CouponController')->middleware('auth');

Route::resource('/refeicoes', 'menuController')->middleware('auth');

Route::resource('/minhaBandeja', 'TrayController')->middleware('auth');

Route::resource('/itensAdicionais', 'ExtrasController')->middleware('auth');

Route::resource('/locaisDeEntrega', 'deliverController')->middleware('auth');

//Rotas de cliente.
Route::get('/tipoPedido', 'TrayController@orderType')->name('tipoPedido')->middleware('auth');

Route::get('/meusCupons', 'CouponController@myCoupons')->name('meusCupons')->middleware('auth');

Route::get('/entrar', 'LoginController@login')->name('entrar');

//Rotas de combo.
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

Route::post('/entregadorAlteraStatus/{id}/{acao}/{remetente}/{idCliente}', 'OrdersController@delivererChangeStatus')->name('entregadorAlteraStatus')->middleware('auth');

Route::post('/clinteAlteraStatus/{id}/{acao}/{remetente}/{idCliente}', 'OrdersController@clientChangesStatus')->name('clienteAlteraStatus')->middleware('auth');

//Rotas de gerenciamento.
Route::get('/emPreparo', 'PreparingController@toPrepare')->name('emPreparo')->middleware('auth');

Route::get('/meusDados', 'ClientsController@myData')->name('meusDados')->middleware('auth');

Route::get('/meusPedidos', 'OrdersController@clientsOrders')->name('meusPedidos')->middleware('auth');


Route::get('/gerenciamento-de-usuarios', 'UserController@userManagement')->name('gerenciamento')->middleware('auth');

Route::get('/toggleAdvert/{id}', 'menuController@toggleAdvert')->name('toggleAdvert')->middleware('auth');

Route::get('/delivery', 'deliverController@deliveryStatus')->name('delivery')->middleware('auth');

Route::get('/entregas', 'DeliveryManController@orders')->name('entregas')->middleware('auth');

Route::post('/changeDeliveryStatus', 'deliverController@changeStatus')->name('changeDeliveryStatus')->middleware('auth');

Route::post('/editDeliveryStatus', 'deliverController@editStatus')->name('editDeliveryStatus')->middleware('auth');

Route::post('/workingTime', 'deliverController@workingTime')->name('workingTime')->middleware('auth');

Route::get('/financeiro', 'FinancialController@index')->name('financeiro')->middleware('auth');

Route::get('/dashboard', 'FinancialController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/pedidosPendentes', 'OrdersController@pending')->name('pedidosPendentes')->middleware('auth');

Route::get('/deletarPendente/{id}', 'OrdersController@deletePending')->name('deletaPendente')->middleware('auth');

Route::get('/confirmarPendente/{id}', 'OrdersController@confirmPending')->name('confirmaPendente')->middleware('auth');

Route::get('/confirmarPedido', 'OrdersController@confirm')->name('confirmarPedido')->middleware('auth');

//Rotas de avaliação.
Route::get('/avaliacoes', 'RatingController@evaluate')->name('avaliacoes')->middleware('auth');

Route::get('/avaliar/{id}', 'RatingController@sendRating')->name('avaliar')->middleware('auth');

Route::get('/avaliacoesClientes', 'RatingController@index')->name('avaliacoesClientes')->middleware('auth');

Route::get('/enviarAvaliacao', 'RatingController@rate')->name('enviarAvaliacao')->middleware('auth');

Route::get('/travarAvaliacoes/{rate}', 'MenuController@ratingLock')->name('travaAvaliacoes')->middleware('auth');

//Rotas do ACL.
Route::resource('/roles', 'RoleController')->middleware('auth');

Route::resource('/permissions', 'PermissionController')->middleware('auth');

Route::get('/rolesAndPermissions', 'PermissionController@routeAuth')->name('routeAuth')->middleware('auth');

Route::post('/rolesAndPermissionsLogin', 'PermissionController@routeAuthLogin')->name('routeAuthLogin')->middleware('auth');

Route::get('/rolesAndPermissionsLock', 'PermissionController@routeAuthLock')->name('routeAuthLock')->middleware('auth');

//Rotas de sincronização entre usuário e tipo de usuário.
Route::get('user/{user}/roles', 'UserController@roles')->name('userRoles')->middleware('auth');

Route::put('user/{user}/roles/sync', 'UserController@rolesSync')->name('userRolesSync')->middleware('auth');

//Rotas de sincronização entre tipo de usuário e permissões.
Route::get('role/{role}/permissions', 'RoleController@permissions')->name('rolePermissions')->middleware('auth');

Route::put('role/{role}/permissions/sync', 'RoleController@permissionsSync')->name('rolePermissionsSync')->middleware('auth');

Route::get('/permissionsList', 'PermissionController@permissions')->name('permissions')->middleware('auth');

Auth::routes();

//Rotas PHP para o Ajax.
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/gerenciamentoPedidos', 'HomeController@hybridHome')->name('hybridHome')->middleware('auth');

Route::get('/dados', 'HomeController@getData')->name('dados')->middleware('auth');

Route::get('/hybridTaking', 'HomeController@hybrid')->name('hybridTaking')->middleware('auth');

Route::get('/deliverTaking', 'HomeController@deliverTaking')->name('deliverTaking')->middleware('auth');

//Rotas Ajax.
Route::get('/ajaxpreparo', 'HomeController@getPrepare')->name('prepajax');

Route::get('/ajaxcozinha', 'HomeController@getKitchen')->name('cozjax');

Route::get('/historicoPedidos', 'OrdersController@index')->name('historicoPedidos')->middleware('auth');;

Route::get('/buscaPedidos', 'LiveSearch@action')->name('buscaPedidos');

Route::get('/pedidoCliente', 'PreparingController@clientOrder')->name('pedidoCliente');

Route::get('/verificarFrete', 'TrayController@verificaFrete')->name('verificarFrete');

//Rotas de notificações

Route::post('/save-token', 'HomeController@saveToken')->name('save-token');

Route::post('/send-notification', 'HomeController@sendNotification')->name('send.notification');

Route::post('/send-deliverNotification', 'HomeController@sendDeliverNotification')->name('send.deliverNotification');

Route::post('/send-cancelnotification', 'HomeController@sendCancelNotification')->name('send.cancelnotification');

