<?php

namespace App\Http\Controllers;

use App\deliver;
use App\DeliveryMan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliveryManController extends Controller
{
    public function orders()
    {
        $user = DB::table('users')
            ->select('name', 'surname')
            ->where('id', '=', Auth::user()->id)
            ->get()->toArray();

        $user = $user[0]->name . ' ' . $user[0]->surname;

        $registered = DB::table('orders')
            ->where('status', '=', 'Em rota de entrega')
            ->where('deliverMan', 'like', '%'.$user . '%')
            ->get();

        $count = DB::table('orders')
            ->where('status', '=', 'Em rota de entrega')
            ->where('deliverMan', 'like', '%'.$user . '%')
            ->get();

        return view('Deliver.deliverOrders', compact('registered', 'count'));
    }

    public function countSendings($id)
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $thisMonth = strftime('%B');
        $thisYear = strftime('%Y');
        $thisDay = strftime('%d');
        $dailyValue = 0;
        $delivers = array();

        $deliveryMan = DB::table('users')
            ->select('name', 'surname', 'id')
            ->where('id', '=', $id)
            ->get()->toArray();

        if ($deliveryMan == null){
            return redirect()->route('gerenciamento');
        }

        $districts = DB::table('delivers')
            ->select('name', 'price')
            ->get()->toArray();

        foreach ($districts as $dt => $value){
            $count = DB::table('orders')
                ->select('id')
                ->where('status', '=', 'Pedido Entregue')
                ->where('idDeliverMan', '=', $id)
                ->where('monthDay', '=', $thisDay)
                ->where('month', '=', $thisMonth)
                ->where('year', '=', $thisYear)
                ->where('district', '=', $value->name)
                ->get()->toArray();

            array_push($delivers, ['bairro' => $value->name, 'total' => count($count)]);
            $mult = doubleval($value->price);

            $dailyValue += count($count) * doubleval($value->price);
        }

        //Contagem total entregue este mês
        $totalToday = 0;
        foreach ($delivers as $ctd => $valuetd){
            $totalToday += $valuetd['total'];
        }

        if (str_contains($dailyValue , '.')){
            $totalValue = $dailyValue;
            if ($totalValue > 0){
                $vals = explode('.', $totalValue);

                $pieces = strlen($vals[0]);
                $piecesAfter = strlen($vals[1]);
            }else{
                $pieces = 0;
            }

            $count2 = strlen($totalValue);

            if ($count2 == 4 && $totalValue > 10){
                $price = $totalValue . '0';
            }elseif ($count2 == 2){
                $price = $totalValue. '.' . '00';
            }elseif($count2 == 5 && $pieces == 3){
                $price = $totalValue. '0';
            }elseif($count2 == 3){
                $price = $totalValue . '0';
            }elseif($pieces == 5  && $count2 >= 6 && $piecesAfter < 2){
                $price = $totalValue . '0';
            }elseif($pieces == 4  && $count2 >= 6 && $piecesAfter < 2){
                $price = $totalValue . '0';
            }
            elseif($pieces > 3 && $count2 >= 6){
                $price = $totalValue;
            } else{
                $price = $totalValue;
            }
        }else{
            $totalValue = $dailyValue;
            $count2 = strlen($totalValue);

            if ($count2 == 4 && $totalValue > 10){
                $price = $totalValue . '0';
            }elseif ($count2 == 2){
                $price = $totalValue. '.' . '00';
            }elseif($count2 == 5){
                $price = $totalValue. '0';
            }elseif($count2 == 3){
                $price = $totalValue . '0';
            }elseif($count2 >= 6){
                $price = $totalValue . '0';
            }elseif($count2 >= 6 ){
                $price = $totalValue . '0';
            }
            elseif($count2 >= 6){
                $price = $totalValue;
            } else{
                $price = $totalValue;
            }if (strlen($dailyValue) == 1){
                $price = $dailyValue . '.00';
            }
        }

        $deliveryMan = DB::table('users')
            ->select('name', 'surname', 'id')
            ->where('id', '=', $id)
            ->get()->toArray();

        $countMonth = array();

        foreach ($districts as $district => $dtvalue){
            $countThis = DB::table('orders')
                ->select('id')
                ->where('status', '=', 'Pedido Entregue')
                ->where('idDeliverMan', '=', $id)
                ->where('month', '=', $thisMonth)
                ->where('year', '=', $thisYear)
                ->where('district', '=', $dtvalue->name)
                ->get()->toArray();

            array_push($countMonth, ['bairro' => $dtvalue->name, 'total' => count($countThis)]);
        }

        //Contagem total entregue este mês
        $totalMonth = 0;
        foreach ($countMonth as $ct => $value){
           $totalMonth += $value['total'];
        }

        return view('User.deliveryManDelivers', compact('delivers', 'countMonth', 'price', 'totalMonth', 'totalToday', 'deliveryMan'));
    }

    public function searchSendings(Request $request, $id)
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $thisMonth = strftime('%B');
        $thisYear = strftime('%Y');

        $districts = DB::table('delivers')
            ->select('name', 'price')
            ->get()->toArray();

        //Valores do mês atual.
        $deliveryMan = DB::table('users')
            ->select('name', 'surname', 'id')
            ->where('id', '=', $id)
            ->get()->toArray();

        //Evitando crashes na aplicação.
        if ($deliveryMan == null or $request->dia == null){
            return redirect()->route('gerenciamento');
        }

        $countMonth = array();

        foreach ($districts as $district => $dtvalue){
            $countThis = DB::table('orders')
                ->select('id')
                ->where('status', '=', 'Pedido Entregue')
                ->where('idDeliverMan', '=', $id)
                ->where('month', '=', $thisMonth)
                ->where('year', '=', $thisYear)
                ->where('district', '=', $dtvalue->name)
                ->get()->toArray();

            array_push($countMonth, ['bairro' => $dtvalue->name, 'total' => count($countThis)]);
        }

        //Contagem total entregue este mês
        $totalMonth = 0;
        foreach ($countMonth as $ct => $value){
            $totalMonth += $value['total'];
        }

        //Contagem do dia filtrado.
        $dailyValue = 0;
        $delivers = array();

        foreach ($districts as $district => $dtvalue){
            $countThis = DB::table('orders')
                ->select('id')
                ->where('status', '=', 'Pedido Entregue')
                ->where('idDeliverMan', '=', $id)
                ->where('monthDay', '=', $request->dia)
                ->where('month', '=', $request->month)
                ->where('year', '=', $request->year)
                ->where('district', '=', $dtvalue->name)
                ->get()->toArray();

            array_push($delivers, ['bairro' => $dtvalue->name, 'total' => count($countThis)]);

            $dailyValue += count($countThis) * doubleval($dtvalue->price);
        }

        //Contando quantas entregas foram feitas no dia filtrado.
        $totalToday = 0;
        foreach ($delivers as $ctd => $valuetd){
            $totalToday += $valuetd['total'];
        }

        if (str_contains($dailyValue , '.')){
            $totalValue = $dailyValue;
            if ($totalValue > 0){
                $vals = explode('.', $totalValue);

                $pieces = strlen($vals[0]);
                $piecesAfter = strlen($vals[1]);
            }else{
                $pieces = 0;
            }

            $count2 = strlen($totalValue);

            if ($count2 == 4 && $totalValue > 10){
                $price = $totalValue . '0';
            }elseif ($count2 == 2){
                $price = $totalValue. '.' . '00';
            }elseif($count2 == 5 && $pieces == 3){
                $price = $totalValue. '0';
            }elseif($count2 == 3){
                $price = $totalValue . '0';
            }elseif($pieces == 5  && $count2 >= 6 && $piecesAfter < 2){
                $price = $totalValue . '0';
            }elseif($pieces == 4  && $count2 >= 6 && $piecesAfter < 2){
                $price = $totalValue . '0';
            }
            elseif($pieces > 3 && $count2 >= 6){
                $price = $totalValue;
            } else{
                $price = $totalValue;
            }
        }else{
            $totalValue = $dailyValue;
            $count2 = strlen($totalValue);

            if ($count2 == 4 && $totalValue > 10){
                $price = $totalValue . '0';
            }elseif ($count2 == 2){
                $price = $totalValue. '.' . '00';
            }elseif($count2 == 5){
                $price = $totalValue. '0';
            }elseif($count2 == 3){
                $price = $totalValue . '0';
            }elseif($count2 >= 6){
                $price = $totalValue . '0';
            }elseif($count2 >= 6 ){
                $price = $totalValue . '0';
            }
            elseif($count2 >= 6){
                $price = $totalValue;
            } else{
                $price = $totalValue;
            }if (strlen($dailyValue) == 1){
                $price = $dailyValue . '.00';
            }
        }

        $day = $request->dia;
        $thisMonth = $request->month;
        $thisYear = $request->year;

        return view('User.deliveryManDelivers', compact('delivers', 'countMonth', 'price', 'totalMonth', 'totalToday', 'deliveryMan', 'day', 'thisMonth', 'thisYear'));
    }
}
