<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Tray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user =  $order = Auth::user()->id;
        $orders = DB::table('orders')->where('idClient', '=', $user)->paginate(9);
        $countOrders = DB::table('orders')->where('idClient', '=', $user)->get();

        return view('clientUser.myOrders', compact('orders', 'countOrders'));
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
        $client = DB::table('users')->select('name', 'surname')->where('id', '=', $order[0]['idClient'])->get();

        $id = $order[0]['id'];


        setlocale(LC_TIME, 'pt_BR', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        //Terminando de adicionar os itens à bandeja.
           $tray = Tray::find($id);
           $tray->deliverWay = $request->formaRetirada;
           $tray->payingMethod = $request->formaPagamento;
           $tray->address = $request->localEntrega;
           $tray->payingValue = $request->valEntregue;
           $tray->clientComments = $request->obs;
           $tray->save();

        //Cadastrando novo pedido.
        $updOrder = Auth::user()->userOrderTray()->get()->toArray();
        $newOrder = new Orders();
        $newOrder->idClient = $updOrder[0]['idClient'];
        $newOrder->clientName = $client[0]->name. ' ' . $client[0]->surname;
        $newOrder->orderType = $updOrder[0]['orderType'];
        $newOrder->comments = $updOrder[0]['comments'];
        $newOrder->detached = $updOrder[0]['detached'];
        $newOrder->hamburguer = $updOrder[0]['hamburguer'];
        $newOrder->fries = $updOrder[0]['portion'];
        $newOrder->drinks = $updOrder[0]['drinks'];
        $newOrder->clientComments = $updOrder[0]['clientComments'];
        $newOrder->deliverWay = $updOrder[0]['deliverWay'];
        $newOrder->totalValue = $updOrder[0]['totalValue'];
        $newOrder->hour = date("G") .":". date("i");
        $newOrder->day =  date("d/m/Y");
        $newOrder->monthDay =  date("d");
        $newOrder->month = strftime('%B', strtotime('today'));
        $newOrder->address = $updOrder[0]['address'];
        $newOrder->payingMethod = $updOrder[0]['payingMethod'];
        $newOrder->payingValue = $updOrder[0]['payingValue'];

        if (isset($request->pedir)) {
            $newOrder->status = 'Pendente';
        }else{
            $newOrder->status = 'Pedido registrado';
        }
        $newOrder->save();


        $clearTray = Tray::find($updOrder[0]['id']);
        $clearTray->delete();

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

    public function changeStatus($id, $acao)
    {
        $order = Orders::find($id);

        if($acao == 'prontoretiradaenvio'){

            if ($order->deliverWay == 'Retirada no restaurante'){
                $order->status = 'Pronto para ser retirado no restaurante';
                $order->save();
            } else if($order->deliverWay == 'Entrega em domicílio'){
                $order->status = 'Em rota de entrega';
                $order->save();
            }


            return redirect()->route('home')->with('msg',
                'Pedido pronto para ser entregue!');


        }else if($acao == 'Cancelado'){

            $order->status = $acao;
            $order->save();

            return redirect()->route('home')->with('msg-2',
                'Pedido cancelado com sucesso!');

        }else if($acao == 'Em preparo' or $acao == 'Pronto'){

            $order->status = $acao;
            $order->save();

            return redirect()->route('home')->with('msg',
                'Pedido disponível para equipe da cozinha.');
        }else if($acao == 'Pedido Entregue'){
            $order->status = $acao;
            $order->save();

        return redirect()->route('home')->with('msg',
                'O pedido foi entregue ao cliente, parabéns à todos pelo empenho!');
        }

    }

    public function update(Request $request, $id, $acao)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

