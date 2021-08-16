<?php

namespace App\Http\Livewire;

use App\Adverts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetachedTray extends Component
{
    public function render()
    {
        $foods = Adverts::all();
        $tray = Auth::user()->userOrderTray()->select('id')->get();
        $val = Auth::user()->userOrderTray()->select('totalValue')->get()->toArray();

        if (isset($tray[0]->id)){
            $items = DB::table('item_without_extras')
                ->select('itemName', 'id')
                ->where('idOrder', '=', $tray[0]->id)
                ->get()->toArray();

            $query = DB::table('auxiliar_detacheds')
                ->select('item', 'nameExtra', 'id')
                ->where('idOrder', '=', $tray[0]->id)
                ->get()->toArray();

            $itemWExtras = array();

            foreach ($query as $it){
                array_push($itemWExtras, ['name' => $it->item . ' + ' . $it->nameExtra, 'id' => $it->id]);
            }
        }

        foreach ($foods as $food){
            $foodFormat = explode(',', $food->extras);
            $one = array();
            foreach ($foodFormat as $t){
                $extra = DB::table('extras')
                    ->select('namePrice')
                    ->where('name', '=', $t)
                    ->get()->toArray();

                foreach ($extra as $ext){
                    array_push($one, $ext->namePrice);
                    $food->extras = $one;
                }
            }
        }

        $rate = DB::table('lock_rating')
            ->get();

        if (isset($rate[0])){
            $rate = $rate[0]->lock;
        }else{
            $rate = "Não";
        }
        
        return view('livewire.detached-tray', compact('foods', 'rate'));
    }
}
