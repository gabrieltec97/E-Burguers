<?php

namespace App\Http\Livewire;

use App\Adverts;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public function render()
    {
        setlocale(LC_TIME, 'pt_BR', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $thisMonth = strftime('%B');
        $thisYear = strftime('%Y');

        $adverts = Adverts::all();
        $orders = DB::table('orders')
            ->select('detached')
            ->where('month', '=', $thisMonth)
            ->where('year', '=', $thisYear)
            ->where('status', '=', 'Pedido Entregue')
            ->get()->toArray();

        $sale = array();
        $total = array();
        foreach ($orders as $ord => $v){
            array_push($total, $v->detached);
        }

        $total = implode(',', $total);

        foreach ($adverts as $advert){

            $numero_palavras = substr_count ($total, $advert->name);
            array_push($sale, ['item' => $advert->name, 'sales' => $numero_palavras]);
            $numero_palavras = 0;
        }

        array_multisort(array_column($sale,'sales'),SORT_DESC, $sale);

        return view('livewire.dashboard', compact('sale'));
    }
}
