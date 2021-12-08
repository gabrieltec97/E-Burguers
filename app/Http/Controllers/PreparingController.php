<?php

namespace App\Http\Controllers;

use App\Adverts;
use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PreparingController extends Controller
{

    public function index()
    {
        $idUser = Auth::user()->id;
        $order = DB::table('orders')->where('idClient', '=', $idUser)->where('status', '!=', 'Pedido Entregue')->where('status', '!=', 'Cancelado')->get()->toArray();

        $items = Adverts::all()->where('foodType', '<>', 'Bebida');
        $eval = \App\User::find(Auth::user()->id);
        $eval = explode(',', $eval->itemsRated);
        $itensToEvaluate = array();

        foreach ($items as $item){
            $evaluate = DB::table('orders')
                ->where('detached', 'like', '%'. $item->name . '%')
                ->where('status', '=', 'Pedido Entregue')
                ->where('idClient', '=', Auth::user()->id)
                ->get()->toArray();

            if (count($evaluate) != ''){
                array_push($itensToEvaluate, [$item->id, $item->name, $item->picture]);
            }
        }

        foreach ($eval as $ev){
            foreach ($itensToEvaluate as $i => $value){
                if ($ev == $value[0]){
                    unset($itensToEvaluate[$i]);
                }
            }
        }

        $rated = DB::table('ratings')
            ->where('idUser', '=', Auth::user()->id)
            ->get()->toArray();

        $orders = DB::table('orders')
            ->where('idClient', '=', Auth::user()->id)
            ->get();

        $rated = [
            'rated' => count($rated),
            'ordered' => count($orders)
        ];

        if (isset($order[0])){
            if ($order[0]->status != 'Pendente'){
                if (session('duplicated')){
                    if (isset($order[0])){
                        $orderStatus = $order[0]->status;
                        $orderDeliver = $order[0]->deliverWay;

                        return view('clientUser.preparing-client', compact('order', 'rated', 'itensToEvaluate', 'orderStatus', 'orderDeliver', 'idUser'))->with('duplicated', ' ');
                    }
                    else {
                        $void = 'void';
                        return view('clientUser.preparing-client', compact('void', 'rated', 'itensToEvaluate'))->with('duplicated', ' ');
                    }
                }else {
                    if (isset($order[0])) {
                        $orderStatus = $order[0]->status;
                        $orderDeliver = $order[0]->deliverWay;

                        return view('clientUser.preparing-client', compact('order', 'rated', 'itensToEvaluate', 'orderStatus', 'orderDeliver', 'idUser'));
                    } else {
                        $void = 'void';
                        return view('clientUser.preparing-client', compact('void', 'rated', 'itensToEvaluate'));
                    }
                }
            }else{
                return view('clientUser.preparing-client', compact('rated', 'itensToEvaluate'));
            }
        }else{
            return view('clientUser.preparing-client', compact('rated', 'itensToEvaluate'));
        }

    }

    public function clientOrder()
    {
        $idUser = Auth::user()->id;
        $dados = DB::table('orders')->select('id', 'hour', 'status', 'deliverWay')
            ->whereRaw("status <> 'Cancelado' and status <> 'Pedido Entregue'")
            ->where('idClient',  '=', $idUser)->get()->toArray();

        return $dados;
    }

    public function toPrepare()
    {
        if(!Auth::user()->hasPermissionTo('Em Preparo')){
            return redirect()->route('home');
        }

        $orders = DB::table('orders')->where('status', '=', 'Em preparo')->get()->toArray();

        return view('Preparing.preparing', compact('orders'));
    }


    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('Em Preparo')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $order = Orders::find($id);
        $order->status = "Pronto";
        $order->save();

        return redirect()->route('emPreparo')->with('msg', 'Obrigado por preparar mais esta refeição!');
    }
}
