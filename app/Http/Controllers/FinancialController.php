<?php

namespace App\Http\Controllers;


use App\Charts\Grafico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    public function index()
    {
        setlocale(LC_TIME, 'pt_BR', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $thisMonth = strftime('%B', strtotime('today'));
        $thisDay = strftime('%d', strtotime('today'));
        $month = DB::table('orders')
            ->where('month', '=', $thisMonth)
            ->where('status', '=', 'Pedido Entregue')
            ->get()->toArray();

        $countDayTen = 0;
        $countDayFifteen = 0;
        $countDayTwenty = 0;
        $countDayTwentyFive = 0;
        $countDayThirty = 0;

        foreach ($month as $mt){
            if ($mt->monthDay <= 10){
                $countDayTen += 1;
            }
        }

        foreach ($month as $mt){
            if ($mt->monthDay <= 15){
                $countDayFifteen += 1;
            }
        }

        foreach ($month as $mt){
            if ($mt->monthDay <= 20){
                $countDayTwenty += 1;
            }
        }

        foreach ($month as $mt){
            if ($mt->monthDay <= 25){
                $countDayTwentyFive += 1;
            }
        }

        foreach ($month as $mt){
            if ($mt->monthDay <= 30){
                $countDayThirty += 1;
            }
        }

        $chart = new Grafico();

        if ($thisDay <= 10){

            $chart->labels(['Início do mês','Até dia 10']);
            $chart->dataset('Total de vendas este mês', 'line' , [0,$countDayTen])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);

        }elseif ($thisDay <= 15){

            $chart->labels(['Início do mês','Até dia 10', 'Até dia 15']);
            $chart->dataset('Total de vendas este mês', 'line' , ['0',$countDayTen,$countDayFifteen])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);

        }elseif ($thisDay <= 20){

            $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20']);
            $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);

        }elseif ($thisDay <= 25){

            $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20', 'Até dia 25']);
            $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty,$countDayTwentyFive])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);

        }elseif ($thisDay <=30){
            $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20', 'Até dia 25', 'Até dia 30']);
            $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty,$countDayTwentyFive,$countDayThirty])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);
        }

        $chart2 = new Grafico();

        $chart2->labels(['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']);
        $chart2->dataset('Total de vendas este ano', 'bar' , [100,200,300,600,150, 234, 277, 430, 330, 76, 0, 0])->options([
            'backgroundColor' => '#ccf5ff',
            'borderColor' => '#008fb3',
            'lineTension' => 0.5
        ]);

        return view('Financial.financial', compact('chart', 'chart2'));
    }

    public function dashboard()
    {

        setlocale(LC_TIME, 'pt_BR', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $thisMonth = strftime('%B', strtotime('today'));
        $thisDay = strftime('%d', strtotime('today'));
        $now = date('d/m/Y');

        $month = DB::table('orders')
            ->where('month', '=', $thisMonth)
            ->where('status', '=', 'Pedido Entregue')
            ->get()->toArray();

        $nowHere = DB::table('orders')
            ->where('day', '=', $now)
            ->where('status', '=', 'Pedido Entregue')
            ->get()->toArray();

        $totalValue = DB::table('orders')
            ->where('status', '=', 'Pedido Entregue')
            ->sum('orders.totalValue');

        $totalValueToday = DB::table('orders')
            ->where('status', '=', 'Pedido Entregue')
            ->where('day', '=', $now)
            ->sum('orders.totalValue');

        $countDayTen = 0;
        $countDayFifteen = 0;
        $countDayTwenty = 0;
        $countDayTwentyFive = 0;
        $countDayThirty = 0;
        $countMonth = count($month);
        $countDayNow = count($nowHere);

        foreach ($month as $mt){
            if ($mt->monthDay <= 10){
                $countDayTen += 1;
            }
        }

        foreach ($month as $mt){
            if ($mt->monthDay <= 15){
                $countDayFifteen += 1;
            }
        }

        foreach ($month as $mt){
            if ($mt->monthDay <= 20){
                $countDayTwenty += 1;
            }
        }

        foreach ($month as $mt){
            if ($mt->monthDay <= 25){
                $countDayTwentyFive += 1;
            }
        }

        foreach ($month as $mt){
            if ($mt->monthDay <= 30){
                $countDayThirty += 1;
            }
        }

        $chart = new Grafico();

        if ($thisDay <= 10){

            $chart->labels(['Início do mês','Até dia 10']);
            $chart->dataset('Total de vendas este mês', 'line' , [0,$countDayTen])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);

        }elseif ($thisDay <= 15){

            $chart->labels(['Início do mês','Até dia 10', 'Até dia 15']);
            $chart->dataset('Total de vendas este mês', 'line' , ['0',$countDayTen,$countDayFifteen])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);

        }elseif ($thisDay <= 20){

            $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20']);
            $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);

        }elseif ($thisDay <= 25){

            $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20', 'Até dia 25']);
            $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty,$countDayTwentyFive])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);

        }elseif ($thisDay <=30){
            $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20', 'Até dia 25', 'Até dia 30']);
            $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty,$countDayTwentyFive,$countDayThirty])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);
        }

        $chart2 = new Grafico();

        $chart2->labels(['Combo', 'Avulso', 'Sobremesa']);
        $chart2->dataset('Total de vendas este ano', 'doughnut' , [100,200,300])->options([
            'backgroundColor' => '#ccf5ff',
//            'borderColor' => '#008fb3',
//            'lineTension' => 0.5
        ]);


        //Recuperando os itens mais vendidos.

        //Avulso
        $det = DB::table('orders')
            ->select(DB::raw('detached, COUNT(detached) as count'))
            ->groupBy('detached')
            ->orderBy(DB::raw('count(detached)'), 'desc')
            ->limit(4)
            ->get()
            ->toArray();

        $detached = [];

        foreach ($det as $key){

            if ($key->count != 0){
                array_push($detached, [
                    'item' => $key->detached,
                    'quantidade' => $key->count
                ]);
            }
        }

        //Combo
        $cb = DB::table('orders')
            ->select(DB::raw('hamburguer, COUNT(hamburguer) as count2'))
            ->groupBy('hamburguer')
            ->orderBy(DB::raw('count(hamburguer)'), 'desc')
            ->limit(4)
            ->get()
            ->toArray();

        foreach ($cb as $ck){

           if ($ck->count2 != 0){
               array_push($detached, [
                   'item' => $ck->hamburguer,
                   'quantidade' => $ck->count2
               ]);
           }
        }

        $novo = [];

        foreach ($detached as $chave => $valor){

            if (isset($novo[$valor['item']])){
                $novo[$valor['item']] += $valor['quantidade'];
            }else{
                $novo[$valor['item']] = $valor['quantidade'];
            }
        }

        $detached = [];

        foreach ($novo as $key2 =>$value2){
            $detached[] = ['item' =>$key2, 'quantidade' => $value2];
        }
        /*Aqui tivemos que inserir tudo no array detached, depois criar o array novo e somar os valores dos índices repetidos,
        em seguida passamos os valores do array novo para o array detached novamente, declarando-o novamente para que este fosse limpo.*/

        return view('Financial.dashboard', compact('chart', 'chart2', 'countMonth', 'countDayNow', 'totalValue', 'totalValueToday', 'detached'));
    }
}
