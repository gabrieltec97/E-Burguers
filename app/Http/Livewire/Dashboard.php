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
        $thisMonth = strftime('%B');
        $thisYear = strftime('%Y');
        $adverts = Adverts::all();
        $items = Adverts::paginate(8);
        $sale = array();
        $total = 0;
        foreach ($adverts as $advert){
            $query = DB::table('orders')
                ->selectRaw("hamburguer,
                    fries,
                    drinks,
	                detached,
                    CHAR_LENGTH(detached) - CHAR_LENGTH(REPLACE(LOWER(detached), '". strtolower($advert->name)."',
                    SPACE(LENGTH('". strtolower($advert->name)."')-1)))
                        AS total ,
                         CHAR_LENGTH(hamburguer) - CHAR_LENGTH(REPLACE(LOWER(hamburguer), '". strtolower($advert->name)."',
                          SPACE(LENGTH('". strtolower($advert->name)."')-1)))
                        AS total2,
                         CHAR_LENGTH(fries) - CHAR_LENGTH(REPLACE(LOWER(fries), '". strtolower($advert->name)."',
                         SPACE(LENGTH('". strtolower($advert->name)."')-1)))
                        AS total3,
                         CHAR_LENGTH(drinks) - CHAR_LENGTH(REPLACE(LOWER(drinks), '". strtolower($advert->name)."',
                         SPACE(LENGTH('". strtolower($advert->name)."')-1)))
                        AS total4")
                ->where('month', '=', $thisMonth)
                ->where('year', '=', $thisYear)
                ->where('status', '=', 'Pedido Entregue')
                ->get()->toArray();

            foreach ($query as $q){
                $total += $q->total + $q->total2 + $q->total3 +$q->total4;
            }

            foreach ($items as $item => $v){
                if ($v->name == $advert->name){
                    $v->total = $total;
                }
            }

            array_push($sale, [$advert->name, $total, $advert->id]);

            $total = 0;
        }
        //Verifica quantos foram vendidos de cada item.

        array_multisort(array_column($sale,'1'),SORT_DESC, $sale);


        return view('livewire.dashboard', compact('items'));
    }
}
