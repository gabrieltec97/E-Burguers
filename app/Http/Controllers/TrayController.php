<?php

namespace App\Http\Controllers;

use App\Adverts;
use App\AuxiliarDetached;
use App\Coupon;
use App\Tray;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function Sodium\compare;

class TrayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tray = $user->userOrderTray()->select('orderType', 'detached', 'hamburguer', 'portion', 'drinks')->get()->toArray();

        if(isset($tray[0]['detached'])){
            $detached = explode(',', $tray[0]['detached']);

            return view('clientUser.tray', compact('tray', 'detached'));
        }else{
            return view('clientUser.tray', compact('tray'));
        }
    }

    public function freeOrder(Request $request, $id)
    {
        $user = Auth::user()->id;
        $item = Adverts::find($id);

        //Verificando se o usuário possui um pedido.
        $verifyOrder = Auth::user()->userOrderTray()->get()->first();

        if(isset($request['ingredients'])){
            $requirements = implode(',', $request['ingredients']);
        }

        if ($verifyOrder == null){

            $order = new Tray();
            $order->idClient = $user;
            $order->orderType = "Avulso";
            $order->day = date('d/m/Y');
            $order->hour = date('H:i');
            $order->detached = $item->name;

            if (isset ($request->extras)){
                //Buscando acompanhamento.
                $extras = [];
                $valorNovo = 0;

                foreach ($request->extras as $ex){
                    $extra = DB::table('extras')
                        ->select('name')
                        ->where('namePrice', '=', $ex)
                        ->get()->toArray();

                    foreach ($extra as $e => $value){
                        array_push($extras, $value);
                    }
                }

                //Somando os valores dos itens adicionais
                foreach ($request->extras as $exts){
                    $vals = DB::table('extras')
                        ->select('price')
                        ->where('namePrice', '=', $exts)
                        ->get()->toArray();

                    foreach ($vals as $v => $vls){
                        $valorNovo += doubleval($vls->price);
                    }
                }

                //Ajustando o array que recebe os itens adicionais

                $add = [];

                foreach ($extras as $ext => $val){
                    array_push($add, $val->name);
                }

                $addItems = implode(', ', $add);

                $addAuxTable = $item->name. ': ' . $addItems;

                $order->extras = $addItems;
                $order->totalValue = $item->value + $valorNovo;
                $order->valueWithoutDisccount = $item->value + $valorNovo;

                if (isset($requirements)){
                    $order->comments = $item->name . ": " .$requirements . ". ";
                }

                $order->save();

                $auxItems = new AuxiliarDetached();
                $auxItems->item = $item->name;
                $auxItems->idOrder = $order->id;
                $auxItems->extras = $addAuxTable;
                $auxItems->nameExtra = $addItems;
                $auxItems->save();

            }else{
                $order->valueWithoutDisccount = $item->value;
                $order->totalValue = $item->value;

                if (isset($requirements)){
                    $order->comments = $item->name . ": " .$requirements . ". ";
                }

                $order->save();
            }

            return redirect(route('cardapio', $insert = 'added'));

        }else{

            $order = Tray::find($verifyOrder->id);
            $items = $order->detached;
            $order->detached = $items . ',' . $item->name;

            if (isset ($request->extras)) {
                //Buscando acompanhamento.
                $extras = [];
                $valorNovo = 0;

                foreach ($request->extras as $ex) {
                    $extra = DB::table('extras')
                        ->select('name')
                        ->where('namePrice', '=', $ex)
                        ->get()->toArray();

                    foreach ($extra as $e => $value) {
                        array_push($extras, $value);
                    }
                }

                //Somando os valores dos itens adicionais
                foreach ($request->extras as $exts) {
                    $vals = DB::table('extras')
                        ->select('price')
                        ->where('namePrice', '=', $exts)
                        ->get()->toArray();

                    foreach ($vals as $v => $vls) {
                        $valorNovo += doubleval($vls->price);
                    }
                }

                //Ajustando o array que recebe os itens adicionais

                $add = [];

                foreach ($extras as $ext => $val) {
                    array_push($add, $val->name);
                }

                $addItems = implode(', ', $add);

                $addAuxTable = $item->name . ': ' . $addItems;

                $order->extras = $addItems;
                $order->totalValue = $item->value + $valorNovo;
                $order->valueWithoutDisccount = doubleval($order->totalValue) + doubleval($item->value) + $valorNovo;

                if (isset($requirements)) {
                    $order->comments = $order->comments . ' ' . $item->name . ": " . $requirements . ". ";
                }

                $order->save();

                $auxItems = new AuxiliarDetached();
                $auxItems->item = $item->name;
                $auxItems->idOrder = $order->id;
                $auxItems->extras = $addAuxTable;
                $auxItems->nameExtra = $addItems;
                $auxItems->save();

            }else{
                $order->totalValue = doubleval($order->totalValue) + doubleval($item->value);
                $order->valueWithoutDisccount = doubleval($order->totalValue) + doubleval($item->value);
            }

            if (isset($requirements)){
              $order->comments = $order->comments . $item->name . ": " .$requirements . ". ";
            }

            $order->save();

            return redirect(route('cardapio', $insert = 'added'));
        }
    }

    public function orderComboHamburguer()
    {
        $foods = DB::table('adverts')
            ->where('foodType', '=', 'hamburguer')
            ->where('combo', '=', 'Sim')
            ->get();

        $extras = DB::table('extras')
            ->select('namePrice')
            ->get()->toArray();


        return view('clientUser.foodMenu.hamburguer', compact('foods', 'extras'));
    }

    public function fries(Request $request, $id)
    {
        if (isset ($request->extras)){
            //Buscando acompanhamento.
            $extras = [];
            $valorNovo = 0;

            foreach ($request->extras as $ex){
                $extra = DB::table('extras')
                    ->select('name')
                    ->where('namePrice', '=', $ex)
                    ->get()->toArray();

                foreach ($extra as $e => $value){
                    array_push($extras, $value);
                }
            }

            //Somando os valores dos itens adicionais
            foreach ($request->extras as $exts){
                $vals = DB::table('extras')
                    ->select('price')
                    ->where('namePrice', '=', $exts)
                    ->get()->toArray();

                foreach ($vals as $v => $vls){
                    $valorNovo += doubleval($vls->price);
                }
            }

            //Ajustando o array que recebe os itens adicionais

            $add = [];

            foreach ($extras as $ext => $val){
                array_push($add, $val->name);
            }

            $addItems = implode(', ', $add);
        }

        $user = Auth::user()->id;
        $hamburguer = Adverts::find($id);
        $foods = DB::table('adverts')
            ->where('foodType', '=', 'acompanhamento')
            ->where('combo', '=', 'Sim')
            ->get();
        $verifyOrder = Auth::user()->userOrderTray()->get()->first();

        if(isset($request['ingredients'])){
            $requirements = implode(',', $request['ingredients']);
        }

        if ($verifyOrder == null){

            $order = new Tray();
            $order->idClient = $user;
            $order->orderType = "Combo";
            $order->day = date('d/m/Y');
            $order->hour = date('H:i');
            $order->hamburguer = $hamburguer->name;
            $order->comments = $requirements;

            if (isset($request->extras)){
                $order->extras = $addItems;
                $order->totalValue = $hamburguer->comboValue + $valorNovo;
            }else{
                $order->totalValue = $hamburguer->comboValue;
            }

            $order->valueWithoutDisccount = $hamburguer->comboValue;
            $order->save();

        }

        if(isset($verifyOrder)){
            if ($verifyOrder->hamburguer == ''){
                $order = Tray::find($verifyOrder->id);
                $order->hamburguer = $hamburguer->name;
                $order->comments = $requirements;

                if (isset($request->extras)){
                    $order->extras = $addItems;
                }

                if($verifyOrder->totalValue != ''){
                    if (isset($request->extras)){
                        $order->totalValue = doubleval($verifyOrder->totalValue) + $hamburguer->comboValue + $valorNovo;
                        $order->valueWithoutDisccount = doubleval($verifyOrder->totalValue) + $hamburguer->comboValue + $valorNovo;
                    }else{
                        $order->totalValue = doubleval($verifyOrder->totalValue) + $hamburguer->comboValue;
                        $order->valueWithoutDisccount = doubleval($verifyOrder->totalValue) + $hamburguer->comboValue;
                    }
                }else{
                    if (isset($request->extras)){
                        $order->totalValue = $hamburguer->comboValue + $valorNovo;
                        $order->valueWithoutDisccount = $hamburguer->comboValue + $valorNovo;
                    }else{
                        $order->totalValue = $hamburguer->comboValue;
                        $order->valueWithoutDisccount = $hamburguer->comboValue;
                    }
                }

                $order->save();
            }

            if ($order->portion == '' or $order->drinks == ''){
                return redirect(route('minhaBandeja.index'));
            }else{
                return redirect(route('fimCompra'));
            }
        }

        return view('clientUser.foodMenu.fries', compact('foods'));
    }

    public function editPortion()
    {
        $foods = DB::table('adverts')
            ->where('foodType', '=', 'acompanhamento')
            ->where('combo', '=', 'Sim')
            ->get();

        //Variável que indica que é uma view de edição
        $edit = true;

        return view('clientUser.foodMenu.fries', compact('foods', 'edit'));
    }

    public function drinks ($idFood)
    {
        $user = Auth::user();
        $myOrder = $user->userOrderTray()->get()->first()->toArray();
        $idOrder = $myOrder['id'];
        $secondFood = Adverts::find($idFood);
        $valueOrder = doubleval($myOrder['totalValue']) + doubleval($secondFood->comboValue);
        $foods = DB::table('adverts')->where('foodType', '=', 'bebida')->get();

        if ($myOrder['portion'] == ''){

            $order = Tray::find($idOrder);
            $order->portion = $secondFood->name;
            $order->totalValue = $valueOrder;
            $order->valueWithoutDisccount = $valueOrder;
            $order->save();

        }

        if ($myOrder['drinks'] == '' or $myOrder['hamburguer'] == ''){
            return redirect(route('minhaBandeja.index'));
        }else{
            return redirect(route('fimCompra'));
        }

        return view('clientUser.foodMenu.drinks', compact('foods'));
    }

    public function editDrink()
    {
        $foods = DB::table('adverts')
            ->where('foodType', '=', 'bebida')
            ->where('combo', '=', 'Sim')
            ->get();

        //Variável que indica que é uma view de edição
        $edit = true;

        return view('clientUser.foodMenu.drinks', compact('foods', 'edit'));
    }

    public function shoppingFinish ($idFood)
    {
        $user = Auth::user();
        $myOrder = $user->userOrderTray()->get()->first()->toArray();
        $idOrder = $myOrder['id'];
        $thirdFood = Adverts::find($idFood);
        $valueOrder = doubleval($myOrder['totalValue']) + doubleval($thirdFood->comboValue);

        if ($myOrder['drinks'] == ''){

            $order = Tray::find($idOrder);
            $order->drinks = $thirdFood->name;
            $order->totalValue = $valueOrder;
            $order->valueWithoutDisccount = $valueOrder;
            $order->save();

        }

        if($myOrder['hamburguer'] == '' or $myOrder['portion'] == ''){
            return redirect(route('minhaBandeja.index'));
        }

        return redirect(route('fimCompra'));
    }

    public function reviewAndFinish()
    {
        $user = Auth::user();
        $myOrder= $user->userOrderTray()->select('id', 'orderType', 'detached', 'hamburguer', 'portion', 'drinks', 'totalValue', 'extras')->get()->first()->toArray();
        //Trazendo os itens customizados.
        $customs = DB::table('auxiliar_detacheds')->select()
            ->where('idOrder', '=', $myOrder['id'])
            ->get()->toArray();
        $pending = DB::table('orders')->select('deliverWay')
            ->where('idClient', '=', $user->id)
            ->where('status', '=', 'Pendente')->get()->toArray();


        if ($pending != null){
            $pendings = $pending[0]->deliverWay;
        }

        if (isset($user->id)){
            $address = DB::table('users')->select('address')->where('id', '=', $user->id)->get()->toArray();
        }

        if(isset($myOrder['detached']) && isset($address[0]->address)){
            $detached = explode(',', $myOrder['detached']);
            $sendAddress = $address[0]->address;

            if (isset($pendings)){

                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('pendings','myOrder', 'detached', 'sendAddress'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('pendings', 'customs', 'myOrder', 'detached', 'sendAddress'));
                }

            }else{
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'detached', 'sendAddress'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'customs', 'detached', 'sendAddress'));
                }
            }

        }
        elseif (isset($myOrder['detached'])){
            $detached = explode(',', $myOrder['detached']);

            if (isset($pendings)){
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'detached', 'pendings'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'customs','detached', 'pendings'));
                }
            }else{
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'detached'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'customs', 'detached'));
                }
            }
        }
        elseif (isset($address[0]->address)){
            $sendAddress = $address[0]->address;

            if (isset($pendings)){
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'pendings'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'customs','sendAddress', 'pendings'));
                }
            }else{
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'customs', 'sendAddress'));
                }
            }
        }
    }

    public function removeExtras(Request $req)
    {
        //Pegando o nome do item, seu valor e o valor total do pedido até o momento.
        $extra = DB::table('trays')
            ->select('extras')
            ->where('id', '=', $req->id)
            ->get()->toArray();

        $trayPrice = DB::table('trays')
            ->select('totalValue')
            ->where('id', '=', $req->id)
            ->get()->toArray();

        $price = DB::table('extras')
            ->select('price')
            ->where('name', '=', $req->extra)
            ->get()->toArray();

        $price = $price[0]->price;

        $trayPrice = $trayPrice[0]->totalValue;

        $extra = $extra[0]->extras;

        $finalValue = $trayPrice - $price;

        //Removendo o item adicional e subtraindo o valor do pedido.

        if (isset($extra)){
            $alter = explode(', ', $extra);
            $position = array_search($req->extra, $alter);
            unset($alter[$position]);
            $updatedExtra = implode(', ', $alter);

            $affected = DB::table('trays')
                ->where('id', '=', $req->id)
                ->update(['extras' => $updatedExtra]);

            $alterValue = DB::table('trays')
                ->where('id', '=', $req->id)
                ->update(['totalValue' => $finalValue]);

            return back()->with('msg', 'Item removido do sanduíche :(');
        }else{
            return back();
        }
    }

    public function orderType()
    {
        //Verificando se o usuário possui um combo ou um item na bandeja, se tiver, delete-o.
        $verifyOrder = Auth::user()->userOrderTray()->get()->first();

        if($verifyOrder != ''){
            $order = Tray::find($verifyOrder->id);
            $order->delete();
        }

        return view('clientUser.orderType');
    }

    public function detached($key)
    {
        $order = Auth::user()->userOrderTray()->get()->first()->toArray();
        $detached = explode(',', $order['detached']);

        //Recuperando alimento para fazer o abatimento no preço
        $food = $detached[$key];
        $foodPriceReduce = DB::table('adverts')->select('value')->where('name', '=', $food)->get()->toArray();

        //Abatimento no preço.
        $value = $order['totalValue'];
        $newValue = doubleval($value) - doubleval($foodPriceReduce[0]->value);

        unset($detached[$key]);

        $detached = implode(',',$detached);

        $editOrder = Tray::find($order['id']);
        $editOrder->detached = $detached;
        $editOrder->totalValue = $newValue;
        $editOrder->valueWithoutDisccount = $newValue;
        $editOrder->save();

        if($detached == ''){
            $editOrder = Tray::find($order['id']);
            $editOrder->delete();
        }

        return redirect(route('minhaBandeja.index'))->with('msg', '.');
    }

    public function couponApply(Request $request)
    {
        $order = Auth::user()->userOrderTray()->select('id', 'orderType', 'detached', 'address', 'extras', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();
        $couponOld = DB::table('coupons')->where('name', '=', $request->cupomDesconto)->get()->toArray();
        $update = Tray::find($order[0]['id']);
        $date = date('Y'. '-' . 'm' . '-' . 'd');

        //Encontrando a data de expiração do cupom e deletando se estiver vencido.
        $expire = DB::table('coupons')
            ->select('expireDate')
            ->where('name', '=', $request->cupomDesconto)->get()->toArray();

        if ($expire != null){
            $formatExpire = $expire[0]->expireDate;
            $couponId = $couponOld[0]->id;

            if ($formatExpire == $date){
                $delete = Coupon::find($couponId);

                $delete->destroy($couponId);
            }
        }

        $coupon = DB::table('coupons')->where('name', '=', $request->cupomDesconto)->get()->toArray();


        if (isset($order[0])) {
            $myOrder = $order[0];
            $sendAddress = $myOrder['address'];
        }

        if (isset($coupon[0])) {

            $couponName = $coupon[0]->name;

            //Verificando se o desconto foi usado.

            if (doubleval($myOrder['totalValue']) >= $coupon[0]->disccountRule) {

                if ($coupon[0]->disccount == '10% de desconto' && $update->disccountUsed != 'Sim') {

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.1);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType','extras', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }

                }elseif ($coupon[0]->disccount == '5% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.05);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType', 'extras', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                }elseif ($coupon[0]->disccount == '15% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.15);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType','extras', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                } elseif ($coupon[0]->disccount == '20% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.2);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType','extras', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                } elseif ($coupon[0]->disccount == '30% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.3);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType','extras', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                } elseif ($coupon[0]->disccount == '50% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.5);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType','extras', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                } elseif ($coupon[0]->disccount == 'R$ 5 reais de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 5;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType','extras', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                } elseif ($coupon[0]->disccount == 'R$ 7 reais de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 7;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType','extras', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                } elseif ($coupon[0]->disccount == 'R$ 10 reais de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 10;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType','extras', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                } elseif ($coupon[0]->disccount == 'R$ 15 reais de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 15;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType', 'detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                }

                //Adicionando cupom de frete grátis. (Veja com o cliente o valor de seu frete).

                elseif ($coupon[0]->disccount == 'Frete Grátis' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 3;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    $order= Auth::user()->userOrderTray()->select('id','orderType', 'extras','detached', 'address', 'hamburguer', 'portion', 'drinks', 'totalValue')->get()->toArray();

                    //Inserindo endereço de entrega.
                    if (isset($order[0])){
                        $myOrder = $order[0];
                        $sendAddress = $myOrder['address'];
                    }

                    //Verificando se é pedido avulso.
                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName'));
                    }

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    $use = 'Este cupom já está sendo utilizado.';

                    if (isset($myOrder['detached'])){
                        $detached = explode(',', $myOrder['detached']);
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName','detached', 'use'));
                    }else{
                        return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'couponName', 'use'));
                    }
                }
            } else{
                $notExist = 'Este cupom só pode ser utilizado nos pedidos acima de R$' . $coupon[0]->disccountRule;

                if (isset($myOrder['detached'])){
                    $detached = explode(',', $myOrder['detached']);
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress','detached', 'notExist'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'notExist'));
                }
            }

        }elseif($coupon == null) {

            $notExist = 'Este cupom não existe ou já expirou.';

            if (isset($myOrder['detached'])){
                $detached = explode(',', $myOrder['detached']);
                return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress','detached', 'notExist'));
            }else{
                return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'sendAddress', 'notExist'));
            }
            }
        }


    public function couponRemove($couponName)
    {
        $order = Auth::user()->userOrderTray()->select('id', 'totalValue', 'valueWithoutDisccount')->get()->toArray();

        if (isset($order[0])){
            $originalValue = $order[0]['valueWithoutDisccount'];
            $id = $order[0]['id'];
        }

        $edit = Tray::find($id);
        $edit->totalValue = $originalValue;
        $edit->disccountUsed = null;
        $edit->save();

        return redirect(route('fimCompra'));
    }


    public function destroy($food)
    {

        //Encontrando usuário e pedido.
        $user = Auth::user();
        $tray = $user->userOrderTray()->select('totalValue','hamburguer', 'portion', 'drinks')->get()->toArray();
        $order = $user->userOrderTray()->select('id')->get()->toArray();
        $orderId = $order[0]['id'];

        //Encontrando alimento para abatimento de preço.
        $foodToResetPrice = DB::table('adverts')->select('comboValue')->where('name', '=', $food)->get()->toArray();
        $price = $foodToResetPrice[0]->comboValue;
        $currentPrice = $tray[0]['totalValue'];

        //Atualizando o valor atual do combo.
        $updatedPrice = doubleval($currentPrice) - doubleval($price);

        $resetPrice = Tray::find($orderId);
        $resetPrice->totalValue = $updatedPrice;
        $resetPrice->save();

        //Removendo alimento da tabela.
        $key = array_search($food, $tray[0]);

        if (in_array($food, $tray[0])){
            DB::table('trays')->where($key, '=', $food)->update([$key => NULL]);
        }

        //Atualizando contagem de itens.
        $newTray = $user->userOrderTray()->select('hamburguer', 'portion', 'drinks')->get()->toArray();

        $count = 0;

        if(isset($newTray[0])){
            if($newTray[0]['hamburguer'] != ''){
                $count = 1;
            }

            if($newTray[0]['drinks'] != ''){
                $count += 1;
            }

            if($newTray[0]['portion'] != ''){
                $count += 1;
            }
        }

        if($count == 0){
            $orderDelete = Tray::find($orderId);
            $orderDelete->delete();
        }

        return redirect(route('minhaBandeja.index'));
    }
}
