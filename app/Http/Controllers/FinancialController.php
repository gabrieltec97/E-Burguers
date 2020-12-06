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
        return view('Financial.dashboard');
    }
}
