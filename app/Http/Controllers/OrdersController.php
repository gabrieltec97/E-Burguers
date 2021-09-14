<?php

namespace App\Http\Controllers;

use App\Adverts;
use App\Orders;
use App\Tray;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function clientsOrders()
    {
        return view('clientUser.myOrders');
    }

    public function pending()
    {
        $user = Auth::user()->id;
        $order = DB::table('orders')
            ->where('idClient', '=', $user)
            ->where('status', '=', 'Pendente')
            ->get();

        return view('clientUser.pending', compact('order'));
    }

    public function deletePending($id)
    {
        DB::table('orders')
            ->where('id', '=', $id)
            ->delete();

        return back()->with('msg-rem', 'deletado');
    }

    public function confirmPending($id)
    {
        DB::table('orders')
            ->where('id', '=', $id)
            ->update(['status' => 'Pedido registrado']);

        return redirect()->route('preparo.index');
    }

    public function confirm()
    {
        $user = Auth::user()['id'];
        Orders::where('idClient', $user)
            ->where('status', 'Pendente')
            ->update(['status' => 'Pedido registrado']);

        return redirect()->route('preparo.index')->with('msg', 'teste');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Auth::user()->userOrderTray()->get()->toArray();

        if ($order == null){
            return redirect()->route('preparo.index')->with('duplicated', ' ');
        }

        //Verificando se há pedidos pendentes e/ou em andamento.
        $pending = DB::table('orders')
            ->where('idClient', '=', Auth::user()->id)
            ->where('status', '=', 'Pendente')
            ->get();

        $going = DB::table('orders')
            ->whereRaw("status <> 'Cancelado' and status <> 'Pedido Entregue' and status <> 'Pendente'")
            ->where('idClient', '=', Auth::user()->id)
            ->get();


        $client = DB::table('users')->select('name', 'surname', 'district', 'address')->where('id', '=', $order[0]['idClient'])->get();
        $districtPrice = DB::table('delivers')
            ->where('name', '=', $client[0]->district)
            ->get()->toArray();

        $districtPrice = $districtPrice[0]->price;

        //Verificando o valor do frete.
        if (count($pending) == 0 and count($going) == 0){

            //Terminando de adicionar os itens à bandeja.
            $id = $order[0]['id'];

            $tray = Tray::find($id);
            $tray->deliverWay = $request->formaRetirada;
            if ($tray->payingMethod == null){
                $tray->payingMethod = $request->formaPagamento;
            }
            if ($request->entrega == 'Entregaemcasa'){
                $tray->address = $client[0]->address;
            }else{
                if ($request->pontoRef != ''){
                    if ($tray->address == null){
                        $tray->address = $request->localEntrega. '. Bairro: '. $request->diffDistrict .' Ponto de referência: ' . $request->pontoRef;
                    }else{
                        $tray->address = $request->localEntrega;
                    }
                }else{
                    if ($tray->address == null){
                        $tray->address = $request->localEntrega . '. Bairro: '. $request->diffDistrict .' Ponto de referência: ' . $request->pontoRef;
                    }else{
                        $tray->address = $request->localEntrega;
                    }

                }
            }
            $tray->payingValue = $request->valEntregue;
            $tray->clientComments = $request->obs;

            if ($request->formaRetirada == 'Retirada no restaurante'){
                $tray->valueWithoutDeliver = $tray->totalValue - $districtPrice;

                //Verificação de uso de cupom de frete grátis.
                if ($tray->disccountUsed == null){
                    $tray->totalValue = $tray->totalValue - $districtPrice;
                }


            }else{
                if ($request->entrega == 'localEntregaFora'){
                    $local = DB::table('delivers')
                        ->where('name', '=', $request->diffDistrict)
                        ->get()->toArray();

                    $tray->valueWithoutDeliver = $tray->totalValue - $districtPrice;
                    $tray->totalValue = $tray->totalValue - $districtPrice + $local[0]->price;
                }
            }
        }else{

            //Inserindo valores de entrega com base no dos pedidos correntes atuais.
            if (count($pending) != 0){
                $id = $order[0]['id'];

                $tray = Tray::find($id);
                $tray->deliverWay = $pending[0]->deliverWay;
                if ($tray->payingMethod == null){
                    $tray->payingMethod = $request->formaPagamento;
                }
                $tray->address = $pending[0]->address;
                $tray->payingValue = $request->valEntregue;
                $tray->clientComments = $request->obs;

            }elseif(count($going) != 0){

                $id = $order[0]['id'];

                $tray = Tray::find($id);
                $tray->deliverWay = $going[0]->deliverWay;
                if ($tray->payingMethod == null){
                    $tray->payingMethod = $request->formaPagamento;
                }

                $tray->address = $going[0]->address;
                $tray->payingValue = $request->valEntregue;
                $tray->clientComments = $request->obs;
            }
        }

        if ($tray->hamburguer != null && $tray->extras != null){

            $tray->hamburguer = $tray->hamburguer . ' Adicionais: ' . $tray->extras . '.';

        }
        $tray->save();

        setlocale(LC_TIME, 'pt_BR', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        //Cadastrando novo pedido.
        $updOrder = Auth::user()->userOrderTray()->get()->toArray();

        if ($request->formaPagamento == 'Dinheiro' && $request->valEntregue < $updOrder[0]['totalValue'] && $request->formaRetirada != 'Retirada no restaurante'){
            return redirect()->back();
        }
        $itemsNoExtras = DB::table('item_without_extras')
            ->select()
            ->where('idOrder', '=', $updOrder[0]['id'])
            ->get()->toArray();

        $itemOne = array();

        foreach ($itemsNoExtras as $it => $vl){
            array_push($itemOne, $vl->item);
        }

        $itemOne = implode(';', $itemOne);

        $itemsWithExtras = DB::table('auxiliar_detacheds')
            ->select()
            ->where('idOrder', '=', $updOrder[0]['id'])
            ->get()->toArray();

        $itemTwo = array();

        foreach ($itemsWithExtras as $it => $vl){
            array_push($itemTwo,   $vl->Extras . '. Adicionais: ' . $vl->nameExtra . ';');
        }

        $itemTwo = implode('', $itemTwo);

        $newOrder = new Orders();
        $newOrder->idClient = $updOrder[0]['idClient'];
        $newOrder->clientName = $client[0]->name. ' ' . $client[0]->surname;
        $newOrder->orderType = $updOrder[0]['orderType'];

        //Verificando a nulidade dos itens para que se evite colocar espaços vazios na hora da impressão em tela.
        if ($itemOne == null){
            $newOrder->detached = $itemTwo;
        }elseif ($itemTwo == null){
            $newOrder->detached = $itemOne;
        } else{
            $newOrder->detached = $itemOne . ';' .$itemTwo;
        }

        if (isset($updOrder[0]['comboItem'])){
            $newOrder->comboItem = $updOrder[0]['comboItem'];
        }

        $newOrder->hamburguer = $updOrder[0]['hamburguer'];
        $newOrder->fries = $updOrder[0]['portion'];
        $newOrder->drinks = $updOrder[0]['drinks'];
        $newOrder->clientComments = $updOrder[0]['clientComments'];
        $newOrder->deliverWay = $updOrder[0]['deliverWay'];
        $newOrder->totalValue = $updOrder[0]['totalValue'];
        $newOrder->hour = date("G") .":". date("i");
        $newOrder->day =  date("d/m/Y");
        $newOrder->year = strftime('%Y');;
        $newOrder->monthDay =  date("d");
        $newOrder->month = strftime('%B', strtotime('today'));
        $newOrder->address = $updOrder[0]['address'];

        if($updOrder[0]['deliverWay'] == "Retirada no restaurante"){
            $newOrder->payingMethod = 'Pagamento no restaurante';
        }else{
            $newOrder->payingMethod = $updOrder[0]['payingMethod'];
        }

        if($itemTwo != null){
            $newOrder->extras = 'Sim';
        }
        $newOrder->payingValue = $updOrder[0]['payingValue'];

        if (isset($request->pedir)) {
            $newOrder->status = 'Pendente';
        }else{
            $newOrder->status = 'Pedido registrado';
        }
        $newOrder->save();

        //Limpando a bandeja e tabelas de itens
        $clearTray = Tray::find($updOrder[0]['id']);
        $clearTray->delete();

        DB::table('auxiliar_detacheds')
            ->where('idOrder', '=', $updOrder[0]['id'])
            ->delete();

        DB::table('item_without_extras')
            ->where('idOrder', '=', $updOrder[0]['id'])
            ->delete();


        if (isset($request->pedir)){
            return redirect()->route('tipoPedido')->with('msg', 'teste');
        }else{
            $user = Auth::user()['id'];
            Orders::where('idClient', $user)
                ->where('status', 'Pendente')
                ->update(['status' => 'Pedido registrado']);

            return redirect(route('preparo.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Orders::find($id);

        return view('Orders.order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function clientChangesStatus($id, $acao, $remetente, $idCliente)
    {
        $order = Orders::find($id);

        //Cancelamento por parte do cliente.
        if ($remetente == 'cliente'){

            $order->status = $acao;
            $order->save();

            $verifyOrder = DB::table('orders')
                ->where('idClient', '=', $idCliente)
                ->where('status', '=', 'Pedido registrado')
                ->orWhere('status', '=', 'Em preparo')
                ->orWhere('status', '=', 'Pronto')
                ->orWhere('status', '=', 'Em rota de entrega')
                ->orWhere('status', '=', 'Pronto para ser retirado no restaurante')
                ->get()->toArray();

            if ($verifyOrder == null){
                return redirect()->route('tipoPedido')->with('msg-cancel',
                    ' ');
            }else{
                return redirect()->back()->with('msg-cancel',
                    ' ');
            }
        }

        //Cancelamento por parte da administração.
        if($acao == 'prontoretiradaenvio'){

            if ($order->deliverWay == 'Retirada no restaurante'){
                $order->status = 'Pronto para ser retirado no restaurante';
                $order->save();
            } else if($order->deliverWay == 'Entrega em domicílio'){
                $order->status = 'Em rota de entrega';
                $order->save();
            }


            return redirect()->back()->with('msg',
                'Pedido pronto para ser entregue!');


        }else if($acao == 'Cancelado' && $remetente == 'atendente'){

            $order->status = $acao;
            $order->save();

            return redirect()->back()->with('msg-2',
                'Pedido cancelado com sucesso!');

        }else if($acao == 'Em preparo' or $acao == 'Pronto'){

            $order->status = $acao;
            $order->save();

            return redirect()->back()->with('msg',
                'Pedido disponível para equipe da cozinha.');

        }else if($acao == 'Pedido Entregue'){
            $order->status = $acao;
            $order->save();

            return redirect()->back()->with('msg-venda',
                ' ');
        }
    }

    public function changeStatus($id, $acao, $remetente, $idCliente)
    {
        if(!Auth::user()->hasPermissionTo('Pedidos (Comum)') && !Auth::user()->hasPermissionTo('Pedidos (Híbrido)')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $order = Orders::find($id);

        //Cancelamento por parte do cliente.
        if ($remetente == 'cliente'){

            $order->status = $acao;
            $order->save();

            $verifyOrder = DB::table('orders')
                ->where('idClient', '=', $idCliente)
                ->where('status', '=', 'Pedido registrado')
                ->orWhere('status', '=', 'Em preparo')
                ->orWhere('status', '=', 'Pronto')
                ->orWhere('status', '=', 'Em rota de entrega')
                ->orWhere('status', '=', 'Pronto para ser retirado no restaurante')
                ->get()->toArray();

            if ($verifyOrder == null){
                return redirect()->route('tipoPedido')->with('msg-cancel',
                ' ');
            }else{
                return redirect()->back()->with('msg-cancel',
                    ' ');
            }
        }


        if($acao == 'prontoretiradaenvio'){

            if ($order->deliverWay == 'Retirada no restaurante'){
                $order->status = 'Pronto para ser retirado no restaurante';
                $order->save();
            } else if($order->deliverWay == 'Entrega em domicílio'){
                $order->status = 'Em rota de entrega';
                $order->save();
            }


            return redirect()->back()->with('msg-prep',
                'Pedido pronto para ser entregue!');


        }else if($acao == 'Cancelado' && $remetente == 'atendente'){

            $order->status = $acao;
            $order->save();

            return redirect()->back()->with('msg-2',
                'Pedido cancelado com sucesso!');

        }else if($acao == 'Em preparo' or $acao == 'Pronto'){

            $order->status = $acao;
            $order->save();

            return redirect()->back()->with('msg',
                'Pedido disponível para equipe da cozinha.');

        }else if($acao == 'Pedido Entregue'){
            $order->status = $acao;
            $order->save();

        return redirect()->back()->with('msg-venda',
               'a ');
        }
    }
}

