<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LiveDetachedTray extends Component
{
    public function render()
    {
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

        return view('livewire.live-detached-tray', compact('items', 'val'));
    }
}
