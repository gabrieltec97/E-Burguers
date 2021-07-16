<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PreparingController extends Controller
{

    public function index()
    {
        $idUser = Auth::user()->id;
        $order = DB::table('orders')->select('id','status', 'deliverWay', 'payingValue', 'totalValue', 'hour')->where('idClient', '=', $idUser)->where('status', '!=', 'Pedido Entregue')->where('status', '!=', 'Cancelado')->get()->toArray();

        if (isset($order[0])){
            if ($order[0]->status != 'Pendente'){
                if (session('duplicated')){
                    if (isset($order[0])){
                        $orderStatus = $order[0]->status;
                        $orderDeliver = $order[0]->deliverWay;

                        return view('clientUser.preparing-client', compact('order', 'orderStatus', 'orderDeliver', 'idUser'))->with('duplicated', ' ');
                    }
                    else {
                        $void = 'void';
                        return view('clientUser.preparing-client', compact('void'))->with('duplicated', ' ');
                    }
                }else {
                    if (isset($order[0])) {
                        $orderStatus = $order[0]->status;
                        $orderDeliver = $order[0]->deliverWay;

                        return view('clientUser.preparing-client', compact('order', 'orderStatus', 'orderDeliver', 'idUser'));
                    } else {
                        $void = 'void';
                        return view('clientUser.preparing-client', compact('void'));
                    }
                }
            }else{
                return view('clientUser.preparing-client');
            }
        }else{
            return view('clientUser.preparing-client');
        }

    }

    public function clientOrder()
    {
        $idUser = Auth::user()->id;
        $dados = DB::table('orders')->select('id', 'hour', 'status', 'deliverWay')
            ->whereRaw("status <> 'Cancelado' and status <> 'Pedido Entregue'")
            ->where('idClient', '=', $idUser)->get()->toArray();

        return $dados;
    }


    public function toPrepare()
    {
        $orders = DB::table('orders')->where('status', '=', 'Em preparo')->simplePaginate(6);

        return view('Preparing.preparing', compact('orders'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        $order = Orders::find($id);
        $order->status = "Pronto";
        $order->save();

        return redirect()->route('emPreparo')->with('msg', 'Obrigado por preparar mais esta refeição!');
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
