<?php

namespace App\Http\Controllers;

use App\Adverts;
use App\AuxiliarDetached;
use App\Coupon;
use App\Extras;
use App\ItemWithoutExtras;
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
        $tray = $user->userOrderTray()->select('id', 'orderType', 'hamburguer', 'comboItem', 'portion', 'drinks')->get()->toArray();
        $addons = Extras::all()->toArray();

        if ($tray[0]['comboItem'] != ''){
            $imgHamburguer = DB::table('adverts')
                ->select('picture')
                ->where('name', '=', $tray[0]['comboItem'])
                ->get()->toArray();

            $tray[0]['imgHamburguer'] = $imgHamburguer[0]->picture;
        }

        if ($tray[0]['portion'] != ''){
            $imgPortion = DB::table('adverts')
                ->select('picture')
                ->where('name', '=', $tray[0]['portion'])
                ->get()->toArray();

            $tray[0]['imgPortion'] = $imgPortion[0]->picture;
        }

        if ($tray[0]['drinks'] != ''){

            $drink = explode("|", $tray[0]['drinks']);
            $drink = $drink[0];

            $imgDrink = DB::table('adverts')
                ->select('picture')
                ->where('name', '=', $drink)
                ->get()->toArray();

            $tray[0]['imgDrink'] = $imgDrink[0]->picture;
        }

        //Recuperando itens que não são hamburguer
        $noExtras = DB::table('adverts')->select('name')
            ->where('foodType', '!=', 'hamburguer')
            ->get()->toArray();

        $formatedNoExtras = [];

        foreach ($noExtras as $n => $v){
            array_push($formatedNoExtras, $v->name);
        }

        if (isset($tray[0]['id'])){
            $extras = DB::table('auxiliar_detacheds')->select('id', 'Item', 'nameExtra')
                ->where('idOrder', '=', $tray[0]['id'])
                ->get()->toArray();

            //Formatando arrays
            $items = [];
            foreach ($extras as $key => $value){
                array_push($items, $value->Item);
            }

            foreach ($extras as $et){
                $imagem = DB::table('adverts')
                    ->select('picture')
                   ->where('name', '=', $et->Item)
                   ->get()->toArray();

               foreach ($imagem as $im){
                   $et->img = $im->picture;
               }
            }
        }

        if (isset($tray[0])){
            $pureItems = DB::table('item_without_extras')
                ->where('idOrder', '=', $tray[0]['id'])
                ->select()
                ->get()->toArray();

            foreach ($pureItems as $pureItem => $val){
               $img = DB::table('adverts')
                   ->select('picture')
                   ->where('name', '=', $val->itemName)
                   ->get()->toArray();

               foreach ($img as $i){
                   $val->img = $i->picture;
               }
            }

            //Verificando se a bandeja possui itens.
            if(isset($pureItems) && isset($tray[0]['id'])){

                return view('clientUser.tray', compact('tray', 'formatedNoExtras', 'pureItems', 'items', 'extras', 'addons'));

            }elseif(isset($pureItems)){

                return view('clientUser.tray', compact('tray', 'pureItems', 'addons', 'formatedNoExtras'));

            }elseif (isset($tray[0]['id'])){

                return view('clientUser.tray', compact('tray', 'items', 'extras', 'addons'));

            }else{
                return view('clientUser.tray', compact('tray'));
            }
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
            $requirements = implode(', ', $request['ingredients']);
        }

        if ($verifyOrder == null){

            if (isset ($request->extras)){

                $order = new Tray();
                $order->idClient = $user;
                $order->orderType = "Avulso";
                $order->day = date('d/m/Y');
                $order->hour = date('H:i');

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

                $order->extras = $addItems;
                $order->totalValue = $item->value + $valorNovo;
                $order->valueWithoutDisccount = $item->value + $valorNovo;

                $order->save();

                $auxItems = new AuxiliarDetached();
                $auxItems->item = $item->name;
                $auxItems->idOrder = $order->id;
                $auxItems->foodType = $item->foodType;

                if (isset($requirements)){
                    $auxItems->extras = $item->name . ": " .$requirements;
                }

                $auxItems->nameExtra = $addItems;
                $auxItems->valueWithExtras = $item->value + $valorNovo;
                $auxItems->save();

            }else{

                //Inserindo itens sem extras.
                $order = new Tray();
                $order->idClient = $user;
                $order->orderType = "Avulso";
                $order->day = date('d/m/Y');
                $order->hour = date('H:i');
                $order->totalValue = $item->value;
                $order->valueWithoutDisccount = $item->value;
                $order->save();

                $itemWithoutExtras = new ItemWithoutExtras();
                $itemWithoutExtras->idOrder = $order->id;
                $itemWithoutExtras->foodType = $item->foodType;

                if (isset($request['ingredients'])){
                    $itemWithoutExtras->item = $item->name . ': ' . $requirements;
                }else{
                    $itemWithoutExtras->item = $item->name;
                }

                if($request->sabor == ''){
                    $itemWithoutExtras->itemName = $item->name;
                }else{
                    $itemWithoutExtras->itemName = $item->name . ' sabor: ' . $request->sabor;
                }

                $itemWithoutExtras->value = $item->value;
                $itemWithoutExtras->save();
            }

            return redirect(route('cardapio', $insert = 'added'));

        }else{

            $order = Tray::find($verifyOrder->id);

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

                $order->extras = $addItems;
                $order->valueWithoutDisccount = $order->totalValue + $item->value + $valorNovo;
                $order->totalValue = $order->totalValue + $item->value + $valorNovo;
                $order->save();

                $auxItems = new AuxiliarDetached();
                $auxItems->item = $item->name;
                $auxItems->idOrder = $order->id;
                $auxItems->foodType = $item->foodType;

                if (isset($requirements)) {
                    $auxItems->extras = $item->name . ": " . $requirements;
                }

                $auxItems->nameExtra = $addItems;
                $auxItems->valueWithExtras = $item->value + $valorNovo;
                $auxItems->save();

            }else{

                $updated = Tray::find($verifyOrder->id);

                $itemWithoutExtras = new ItemWithoutExtras();
                $itemWithoutExtras->idOrder = $order->id;
                $itemWithoutExtras->foodType = $item->foodType;

                if (isset($request['ingredients'])){
                    $itemWithoutExtras->item = $item->name . ': ' . $requirements;
                }else{
                    $itemWithoutExtras->item = $item->name;
                }

                $itemWithoutExtras->itemName = $item->name;
                $itemWithoutExtras->value = $item->value;
                $itemWithoutExtras->save();

                $order->totalValue = $updated->totalValue + $item->value;
                $order->valueWithoutDisccount = $updated->totalValue + $item->value;
            }

            $order->save();

            return redirect(route('cardapio', $insert = 'added'));
        }
    }

    public function addExtraItem(Request $request, $id)
    {
       //Buscando os itens e os formatando para entrar na tabela.
       $extras = array();
       $price = 0;

       foreach ($request->ingredients as $ingredient){

           $query = DB::table('extras')
               ->select('name', 'price')
               ->where('namePrice', '=', $ingredient)
               ->get()->toArray();

           array_push($extras, $query[0]->name);
           $price += $query[0]->price;
       }

       $extras = implode(', ', $extras);

       $item = ItemWithoutExtras::find($id);

       $newExtraItem = new AuxiliarDetached();
       $newExtraItem->idOrder = $item->idOrder;
       $newExtraItem->foodType = $item->foodType;
       $newExtraItem->item = $item->itemName;
       $newExtraItem->Extras = $item->item;
       $newExtraItem->nameExtra = $extras;
       $newExtraItem->valueWithExtras = $item->value + $price;
       $newExtraItem->save();

        $myOrder= Auth::user()->userOrderTray()->select('id', 'totalValue')->get()->first()->toArray();

        DB::table('trays')
            ->where('id', '=', $myOrder['id'])
            ->update(['totalValue' => $myOrder['totalValue'] + $price]);

        $item->delete();

        return redirect()->back()->with('msg-2', ' ');

    }

    public function removePersonalized($id)
    {
        $personalized = AuxiliarDetached::find($id);
        $order = Tray::find($personalized->idOrder);

        $order->totalValue = $order->totalValue - $personalized->valueWithExtras;
        $order->save();

        $orderDelete = Tray::find($personalized->idOrder);

        if ($orderDelete->totalValue == 0){
            $orderDelete->delete();
        }
        $personalized->delete();

        return redirect()->route('minhaBandeja.index')->with('msg', ' ');
    }

    public function editPersonalized(Request $req, $id)
    {
        $personalized = AuxiliarDetached::find($id);

        //Recuperando o id do pedido com base no id do item personalizado.
        $tray = DB::table('auxiliar_detacheds')->select('idOrder', 'valueWithExtras', 'nameExtra')
            ->where('id', '=', $id)
            ->get()->first();

        $editTray = Tray::find($tray->idOrder);

        //Recuperando o valor do produto.
        $data = DB::table('adverts')->select('name','value')
            ->where('name', '=', $personalized->Item)
            ->get()->toArray();

        //Recuperando o valor do adicional e somando com o item.
        $value = $data[0]->value;
        $val = 0;

        if (isset($req->ingredients)) {
            foreach ($req->ingredients as $ing) {
                $v = DB::table('extras')->select('price')
                    ->where('name', '=', $ing)
                    ->get()->toArray();

                foreach ($v as $item) {
                    $val += $item->price;
                }
            }
        }

        if (isset($req->ingredients)){
            $ingredients = implode(', ', $req->ingredients);
        }

        //Abatendo o preço com os itens removidos.

        if ($val != 0){
            $newValue = $value + $val;

            $updateValue = $tray->valueWithExtras - $newValue;

            $personalized->nameExtra = $ingredients;
            $personalized->valueWithExtras = $newValue;
            $editTray->totalValue = $editTray->totalValue - $updateValue;
        }else{

            $oldExtras = explode(', ', $tray->nameExtra);

            $updateValue = 0;

            foreach ($oldExtras as $old){

                $extra = DB::table('extras')->select('price')
                    ->where('name', '=' ,$old)
                    ->get()->toArray();

                $updateValue += $extra[0]->price;
            }

//            $personalized->Extras = null;
            $personalized->nameExtra = null;
            $personalized->valueWithExtras = $value;
            $editTray->totalValue = $editTray->totalValue - $updateValue;
        }

        $personalized->save();
        $editTray->save();

        return redirect()->route('fimCompra')->with('msg-2', ' ');
    }

    public function editComboExtras(Request $request)
    {
        $verifyOrder = Auth::user()->userOrderTray()->get()->first();

        if ($request->ingredients != null){
            $extras = explode(', ', $verifyOrder->extras);

            //Verificando quais itens não tem no array e capturando o preço deles.
            $difference = array_diff($request->ingredients, $extras);
            $price = 0;

            if ($difference != null){

                foreach ($difference as $dif){

                    $item = DB::table('extras')
                        ->select('price')
                        ->where('name', '=', $dif)
                        ->get()->toArray();

                    $price += $item[0]->price;
                }

                $verifyOrder->totalValue = $verifyOrder->totalValue + $price;
                $verifyOrder->extras = implode(', ', $request->ingredients);
                $verifyOrder->save();

                return back()->with('msg-add', 'Item removido do sanduíche :(');

            }else{

                $remove = array_diff($extras, $request->ingredients);

                foreach ($remove as $rem){

                    $item = DB::table('extras')
                        ->select('price')
                        ->where('name', '=', $rem)
                        ->get()->toArray();

                    $price += $item[0]->price;
                }

                $verifyOrder->totalValue = $verifyOrder->totalValue - $price;
                $verifyOrder->extras = implode(', ', $request->ingredients);
                $verifyOrder->save();

                return back()->with('msg-rem', 'Item removido do sanduíche :(');
            }

        } else{

            $extras = $verifyOrder->extras;

            $item = DB::table('extras')
                ->select('price')
                ->where('name', '=', $extras)
                ->get()->toArray();


            $verifyOrder->totalValue = $verifyOrder->totalValue - $item[0]->price;
            $verifyOrder->extras = null;
            $verifyOrder->save();

            return back()->with('msg-rem', 'Item removido do sanduíche :(');
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
            $requirements = implode(', ', $request['ingredients']);
        }

        if ($verifyOrder == null){

            $order = new Tray();
            $order->idClient = $user;
            $order->orderType = "Combo";
            $order->day = date('d/m/Y');
            $order->hour = date('H:i');
            $order->image = $hamburguer->picture;
            $order->hamburguer = $hamburguer->name . ': '. $requirements;
            $order->comboItem = $hamburguer->name;

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
                $order->image = $hamburguer->picture;
                $order->hamburguer = $hamburguer->name . ': '. $requirements;
                $order->comboItem = $hamburguer->name;

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

    public function shoppingFinish (Request $request, $idFood)
    {
        $user = Auth::user();
        $myOrder = $user->userOrderTray()->get()->first()->toArray();
        $idOrder = $myOrder['id'];
        $thirdFood = Adverts::find($idFood);
        $valueOrder = doubleval($myOrder['totalValue']) + doubleval($thirdFood->comboValue);

        if ($myOrder['drinks'] == ''){

            $order = Tray::find($idOrder);

            if($request->sabor == ''){
                $order->drinks = $thirdFood->name;
            }else{
                $order->drinks = $thirdFood->name . '| sabor: ' . $request->sabor;
            }

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
        $myOrder= $user->userOrderTray()->select('id', 'orderType', 'hamburguer', 'image', 'comboItem', 'portion', 'drinks', 'totalValue', 'extras')->get()->first()->toArray();
        $exist= DB::table('orders')
            ->select('status', 'deliverWay')
            ->whereRaw("status <> 'Cancelado' and status <> 'Pedido Entregue'")
            ->get()->toArray();

        $separated = DB::table('orders')
            ->where('status', '=', 'Pendente')
            ->count();

        if ($separated == 0 && count($exist) != 0){
            $separated = 1;
        }

        //Capturando os itens adicionais.
        $aditionals = Extras::all()->toArray();
        $addons = array();

        foreach ($aditionals as $ad => $value){
            array_push($addons, $value['name']);
        }

        $items = DB::table('item_without_extras')
            ->select()
            ->where('idOrder', '=', $myOrder['id'])
            ->get()->toArray();

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


        if(isset($items) && isset($address[0]->address)){
            $sendAddress = $address[0]->address;

            if (isset($pendings)){

                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('pendings', 'exist', 'separated', 'myOrder', 'items', 'sendAddress', 'addons'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('pendings', 'exist', 'separated',  'customs', 'myOrder', 'items', 'sendAddress', 'addons'));
                }

            }else{
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated',  'items', 'sendAddress', 'addons'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated',  'customs', 'items', 'sendAddress', 'addons'));
                }
            }

        }
        elseif (isset($items)){

            if (isset($pendings)){
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated', 'items', 'pendings', 'addons'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated', 'customs','items', 'pendings', 'addons'));
                }
            }else{
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated', 'items', 'addons'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated', 'customs', 'items', 'addons'));
                }
            }
        }

        elseif (isset($address[0]->address)){
            $sendAddress = $address[0]->address;

            if (isset($pendings)){
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated', 'sendAddress', 'pendings', 'addons'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated', 'customs','sendAddress', 'pendings', 'addons'));
                }
            }else{
                if ($customs == null){
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated', 'sendAddress', 'addons'));
                }else{
                    return view('clientUser.foodMenu.shoppingFinish', compact('myOrder', 'exist', 'separated', 'customs', 'sendAddress', 'addons'));
                }
            }
        }
    }

    public function removeCustom($id)
    {
        $delete = AuxiliarDetached::find($id);
        $order = Tray::find($delete->idOrder);

        $order->totalValue = $order->totalValue - $delete->valueWithExtras;
        $order->save();

        DB::table('auxiliar_detacheds')
            ->where('id', '=', $id)
            ->delete();

        $orderDelete = Tray::find($delete->idOrder);

        if ($orderDelete->totalValue == 0){
            $orderDelete->delete();
        }

        return redirect(route('minhaBandeja.index'))->with('msg', '.');
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

            $addons = DB::table('auxiliar_detacheds')->select('idOrder')
            ->where('idOrder', '=', $verifyOrder->id)
            ->get()->toArray();

            if ($addons != null) {
                DB::table('auxiliar_detacheds')
                    ->where('idOrder', '=', $verifyOrder->id)
                    ->delete();
            }
        }

        return view('clientUser.orderType');
    }

    public function detached($key)
    {
        $order = Auth::user()->userOrderTray()->get()->first()->toArray();
        $item = DB::table('item_without_extras')
            ->select()
            ->where('id', '=', $key)
            ->get()->toArray();

        //Abatendo o preço na tabela de pedido.
        $updateOrder = $order['totalValue'] - $item[0]->value;

        DB::table('trays')
            ->where('id', '=', $order['id'])
            ->update(['totalValue' => $updateOrder]);

        //Deletando o item da tabela de itens sem extras.
        DB::table('item_without_extras')
            ->where('id', '=', $key)
            ->delete();

//        //Deletando coluna da tabela caso ela esteja vazia.
//        $updTray = Auth::user()->userOrderTray()->get()->first()->toArray();
//
//        if ($updTray['totalValue'] == 0){
//            DB::table('trays')
//                ->where('id', '=', $order['id'])
//                ->delete();
//
//            return redirect(route('minhaBandeja.index'))->with('msg', '.');
//        }

        return redirect(route('minhaBandeja.index'))->with('msg', '.');
    }

    public function couponApply(Request $request)
    {
        $order = Auth::user()->userOrderTray()->select('id', 'orderType', 'comboItem', 'detached', 'address', 'extras', 'hamburguer', 'portion', 'image', 'drinks', 'totalValue')->get()->toArray();
        $couponOld = DB::table('coupons')->where('name', '=', $request->cupomDesconto)->get()->toArray();
        $update = Tray::find($order[0]['id']);
        $date = date('Y'. '-' . 'm' . '-' . 'd');

        //Capturando os itens adicionais.
        $aditionals = Extras::all()->toArray();
        $addons = array();

        foreach ($aditionals as $ad => $value){
            array_push($addons, $value['name']);
        }

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

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');

                }elseif ($coupon[0]->disccount == '5% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.05);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');

                }elseif ($coupon[0]->disccount == '15% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.15);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');

                } elseif ($coupon[0]->disccount == '20% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.2);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');

                } elseif ($coupon[0]->disccount == '30% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.3);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');

                } elseif ($coupon[0]->disccount == '50% de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - (doubleval($myOrder['totalValue']) * 0.5);
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');

                } elseif ($coupon[0]->disccount == 'R$ 5 reais de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 5;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                  //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');

                } elseif ($coupon[0]->disccount == 'R$ 7 reais de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 7;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');

                } elseif ($coupon[0]->disccount == 'R$ 10 reais de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 10;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');

                } elseif ($coupon[0]->disccount == 'R$ 15 reais de desconto' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 15;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');
                }

                //Adicionando cupom de frete grátis. (Veja com o cliente o valor de seu frete).

                elseif ($coupon[0]->disccount == 'Frete Grátis' && $update->disccountUsed != 'Sim'){

                    $disccount = doubleval($myOrder['totalValue']) - 3;
                    $totalValue = number_format($disccount, 2, '.', '');

                    $update->totalValue = $totalValue;
                    $update->disccountUsed = 'Sim';
                    $update->save();

                    return redirect()->back()->with('msg-success', $couponName);

                    //Verificando se o cupom já está sendo utilizado.
                }elseif($update->disccountUsed == 'Sim'){

                    return redirect()->back()->with('msg-use', 'Este cupom já está sendo utilizado.');
                }
            } else{
                $notExist = 'Este cupom só pode ser utilizado nos pedidos acima de R$' . $coupon[0]->disccountRule;

                return redirect()->back()->with('msg-exp', $notExist);
            }

        }elseif($coupon == null) {

            return redirect()->back()->with('msg-exp', 'Este cupom não existe ou já expirou');

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
        $tray = $user->userOrderTray()->select('totalValue', 'hamburguer', 'portion', 'drinks')->get()->toArray();
        $order = $user->userOrderTray()->select('id')->get()->toArray();
        $orderId = $order[0]['id'];

        //Encontrando alimento para abatimento de preço.
        $formatFood = explode('|', $food);
        $formatFood = $formatFood[0];
        $foodToResetPrice = DB::table('adverts')->select('comboValue')->where('name', '=', $formatFood)->get()->toArray();
        $price = $foodToResetPrice[0]->comboValue;
        $currentPrice = $tray[0]['totalValue'];

        //Encontrando extras para abatimento de preço.
        $extras = $user->userOrderTray()->select('extras')->get()->toArray();
        $extras = $extras[0]['extras'];
        $extras = explode(',', $extras);

        if ($extras[0] != ''){

        //Recuperando o preço de cada adicional.
        $extraPrices = 0;
        foreach ($extras as $extra){
            $test = DB::table('extras')->select('price')->where('name', '=', ltrim($extra))->get()->toArray();
            $extraPrices += doubleval($test[0]->price);
            }
        }

        //Atualizando o valor atual do combo.
        if (isset($extraPrices)){
            $updatedPrice = doubleval($currentPrice) - doubleval($price) - doubleval($extraPrices);
        }else{
            $updatedPrice = doubleval($currentPrice) - doubleval($price);
        }

        $resetPrice = Tray::find($orderId);
        $resetPrice->totalValue = $updatedPrice;
        $resetPrice->valueWithoutDisccount = $updatedPrice;
        $resetPrice->save();

        //Removendo alimento da tabela.
        $removeFood = Tray::find($orderId);

        if ($removeFood->comboItem == $food){
            $removeFood->hamburguer = null;
            $removeFood->comboItem = null;
            $removeFood->image = null;
        }elseif ($removeFood->drinks == $food){
            $removeFood->drinks = null;
        }elseif ($removeFood->portion == $food){
            $removeFood->portion = null;
        }
        $removeFood->save();

        return redirect(route('minhaBandeja.index'));
    }
}
