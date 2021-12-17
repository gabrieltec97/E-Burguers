<?php

namespace App\Http\Controllers;


use App\Adverts;
use App\Charts\Grafico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FinancialController extends Controller
{
    public function index(Request $req)
    {
        if(!Auth::user()->hasPermissionTo('Informações Financeiras')){
            return redirect()->route('home');
        }

        setlocale(LC_TIME, 'pt_BR', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        if (isset($req->month)){

            if ($req->month == strftime('%B')){

                $thisMonth = strftime('%B');

                $thisDay = strftime('%d', strtotime('today'));
                $thisYear = strftime('%Y');
                $month = DB::table('orders')
                    ->where('month', '=', $thisMonth)
                    ->where('year', '=', $thisYear)
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
                    if ($mt->monthDay <= 31){
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

                }elseif ($thisDay <=31){
                    $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20', 'Até dia 25', 'Até dia 31']);
                    $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty,$countDayTwentyFive,$countDayThirty])->options([
                        'backgroundColor' => '#ccf5ff',
                        'borderColor' => '#008fb3',
                        'lineTension' => 0.5
                    ]);
                }

            }else{
                $thisMonth = $req->month;

                $thisYear = strftime('%Y');
                $month = DB::table('orders')
                    ->where('month', '=', $thisMonth)
                    ->where('year', '=', $thisYear)
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
                    if ($mt->monthDay <= 31){
                        $countDayThirty += 1;
                    }
                }

                $chart = new Grafico();

                $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20', 'Até dia 25', 'Até dia 31']);
                $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty,$countDayTwentyFive,$countDayThirty])->options([
                    'backgroundColor' => '#ccf5ff',
                    'borderColor' => '#008fb3',
                    'lineTension' => 0.5
                ]);

            }

        }else{
            $thisMonth = strftime('%B');

            $thisDay = strftime('%d', strtotime('today'));
            $thisYear = strftime('%Y');
            $month = DB::table('orders')
                ->where('month', '=', $thisMonth)
                ->where('year', '=', $thisYear)
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
                if ($mt->monthDay <= 31){
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

            }elseif ($thisDay <=31){
                $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20', 'Até dia 25', 'Até dia 31']);
                $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty,$countDayTwentyFive,$countDayThirty])->options([
                    'backgroundColor' => '#ccf5ff',
                    'borderColor' => '#008fb3',
                    'lineTension' => 0.5
                ]);
            }
        }


        $months = array('janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro');

        $countSale = [];

        //Capturando o ano selecionado pelo usuário.
        if (isset($req->year)) {
            $year = $req->year;

            foreach ($months as $m){
                $totalThisMonth = DB::table('orders')
                    ->where('month', '=', $m)
                    ->where('year', '=', $year)
                    ->where('status', '=', 'Pedido Entregue')
                    ->sum('orders.totalValue');

                array_push($countSale, [
                    'mes' => $m,
                    'valor' => $totalThisMonth
                ]);
            }
        }else{

            foreach ($months as $m){
                $totalThisMonth = DB::table('orders')
                    ->where('month', '=', $m)
                    ->where('year', '=', $thisYear)
                    ->where('status', '=', 'Pedido Entregue')
                    ->sum('orders.totalValue');

                array_push($countSale, [
                    'mes' => $m,
                    'valor' => $totalThisMonth
                ]);
            }
        }

        $chart2 = new Grafico();

        $chart2->labels(['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']);
        $chart2->dataset('Valor arrecadado', 'bar' , [round($countSale[0]['valor'], 2),round($countSale[1]['valor'], 2),round($countSale[2]['valor'], 2),round($countSale[3]['valor'], 2),round($countSale[4]['valor'], 2),round($countSale[5]['valor'], 2),round($countSale[6]['valor'], 2),round($countSale[7]['valor'], 2),round($countSale[8]['valor'], 2),round($countSale[9]['valor'], 2),round($countSale[10]['valor'], 2),round($countSale[11]['valor'], 2)])->options([
            'backgroundColor' => '#ccf5ff',
            'borderColor' => '#008fb3',
            'lineTension' => 0.5
        ]);

        //capturando os 3 anos anteriores para filtro de vendas.
        $lastYear = $thisYear - 1;
        $beforeLastYear = $lastYear - 1;
        $evenBeforeLastYear = $beforeLastYear - 1;

        $yearsBefore = array($thisYear,$lastYear, $beforeLastYear, $evenBeforeLastYear);

        if (isset($req->dia) && isset($req->mesvenda)){

            $day = $req->dia;
            $reqmonth = $req->mesvenda;

            $sales = DB::table('orders')
                ->where('monthDay', '=', $req->dia)
                ->where('month', '=', $req->mesvenda)
                ->where('year', '=', $thisYear)
                ->where('status', '=', 'Pedido Entregue')
                ->get()->toArray();

            $money = DB::table('orders')
                ->where('monthDay', '=', $req->dia)
                ->where('month', '=', $req->mesvenda)
                ->where('year', '=', $thisYear)
                ->where('status', '=', 'Pedido Entregue')
                ->sum('totalValue');

            $sales = count($sales);
        }else{

            $thisDay = strftime('%d', strtotime('today'));
            $day = strftime('%d', strtotime('today'));
            $reqmonth = strftime('%B');

            $sales = DB::table('orders')
                ->where('monthDay', '=', strftime('%d', strtotime('today')))
                ->where('month', '=', strftime('%B'))
                ->where('year', '=', $thisYear)
                ->where('status', '=', 'Pedido Entregue')
                ->get()->toArray();

            $money = DB::table('orders')
                ->where('monthDay', '=', strftime('%d', strtotime('today')))
                ->where('month', '=', strftime('%B'))
                ->where('year', '=', $thisYear)
                ->where('status', '=', 'Pedido Entregue')
                ->sum('totalValue');

            $sales = count($sales);
        }

        if (isset($year)){
            $ano = $year;

            if (isset($day)){
                return view('Financial.financial', compact('chart', 'chart2', 'thisMonth', 'yearsBefore', 'ano', 'thisDay', 'sales', 'money', 'day', 'reqmonth'));
            }else{
                return view('Financial.financial', compact('chart', 'chart2', 'thisMonth', 'yearsBefore', 'ano', 'thisDay', 'sales', 'money'));
            }

        }else{
            $ano = $thisYear;

            if (isset($day)){
                return view('Financial.financial', compact('chart', 'chart2', 'thisMonth', 'yearsBefore', 'ano', 'thisDay', 'sales', 'money', 'day', 'reqmonth'));
            }else{
                return view('Financial.financial', compact('chart', 'chart2', 'thisMonth', 'yearsBefore', 'ano', 'thisDay', 'sales', 'money'));
            }
        }
    }

    public function dashboard()
    {
        if(!Auth::user()->hasPermissionTo('Dashboard')){
            return redirect()->route('home');
        }

        setlocale(LC_TIME, 'pt_BR', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $thisMonth = strftime('%B', strtotime('today'));
        $thisDay = strftime('%d', strtotime('today'));
        $thisYear = strftime('%Y');
        $now = date('d/m/Y');

        $month = DB::table('orders')
            ->where('month', '=', $thisMonth)
            ->where('year', '=', $thisYear)
            ->where('status', '=', 'Pedido Entregue')
            ->get()->toArray();

        $nowHere = DB::table('orders')
            ->where('day', '=', $now)
            ->where('status', '=', 'Pedido Entregue')
            ->where('year', '=', $thisYear)
            ->get()->toArray();

        $totalValue = DB::table('orders')
            ->where('month', '=', $thisMonth)
            ->where('status', '=', 'Pedido Entregue')
            ->where('year', '=', $thisYear)
            ->sum('orders.totalValue');

        $totalValueToday = DB::table('orders')
            ->where('status', '=', 'Pedido Entregue')
            ->where('year', '=', $thisYear)
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
            if ($mt->monthDay <= 31){
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

        }elseif ($thisDay <=31){
            $chart->labels(['Início do mês','Até dia 10', 'Até dia 15', 'Até dia 20', 'Até dia 25', 'Até dia 31']);
            $chart->dataset('Total de vendas este mês', 'line' , [0, $countDayTen,$countDayFifteen,$countDayTwenty,$countDayTwentyFive,$countDayThirty])->options([
                'backgroundColor' => '#ccf5ff',
                'borderColor' => '#008fb3',
                'lineTension' => 0.5
            ]);
        }


        //Recuperando os itens mais vendidos.
        $detached = [];

//        //Combo
//        $cb = DB::table('orders')
//            ->select(DB::raw('comboItem, COUNT(comboItem) as count2'))
//            ->groupBy('comboItem')
//            ->orderBy(DB::raw('count(comboItem)'), 'desc')
//            ->limit(4)
//            ->get()
//            ->toArray();
//
//        foreach ($cb as $ck){
//
//           if ($ck->count2 != 0){
//               array_push($detached, [
//                   'item' => $ck->comboItem,
//                   'quantidade' => $ck->count2
//               ]);
//           }
//        }

        $adverts = Adverts::all();
        $sale = array();
        $total = 0;
        foreach ($adverts as $advert){
            $query = DB::table('orders')
                ->selectRaw("
	                detached,
                    CHAR_LENGTH(detached) - CHAR_LENGTH(REPLACE(LOWER(detached), '". strtolower($advert->name)."',
                    SPACE(LENGTH('". strtolower($advert->name)."')-1)))
                        AS total")
                ->where('month', '=', $thisMonth)
                ->where('year', '=', $thisYear)
                ->where('status', '=', 'Pedido Entregue')
                ->get()->toArray();

            foreach ($query as $q){
                $total += $q->total;
            }

            DB::table('adverts')
                ->where('name', '=', $advert->name)
                ->update(['totalSale' => $total]);

            array_push($sale, [$advert->name, $total, $advert->id]);

            $total = 0;
        }

        //Verifica quantos foram vendidos de cada item.
        array_multisort(array_column($sale,'1'),SORT_DESC, $sale);

        if (isset($sale[0])){
            $label1 = $sale[0][0];
            $val1 = $sale[0][1];
        }else{
            $label1 = '';
            $val1 = '';
        }

        if (isset($sale[1])){
            $label2 = $sale[1][0];
            $val2 = $sale[1][1];
        }else{
            $label2 = '';
            $val2 = '';
        }

        if (isset($sale[2])){
            $label3 = $sale[2][0];
            $val3 = $sale[2][1];
        }else{
            $label3 = '';
            $val3 = '';
        }

        if (isset($sale[3])){
            $label4 = $sale[3][0];
            $val4 = $sale[3][1];
        }else{
            $label4 = '';
            $val4 = '';
        }

        $chart2 = new Grafico();

        $chart2->labels([$label1, $label2, $label3, $label4]);
        $chart2->dataset('Total de vendas este ano', 'doughnut' , [$val1, $val2, $val3, $val4])->options([
            'backgroundColor' => [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
        ]);


        return view('Financial.dashboard', compact('chart', 'chart2', 'countMonth', 'countDayNow', 'totalValue', 'totalValueToday', 'sale'));
    }
}
