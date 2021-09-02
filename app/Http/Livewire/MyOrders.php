<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrders extends Component
{
    use WithPagination;

    public function render()
    {
        $user = Auth::user()->id;
        $orders = DB::table('orders')->where('idClient', '=', $user)->paginate(9);
        $countOrders = DB::table('orders')->where('idClient', '=', $user)->get();

        return view('livewire.my-orders', compact('orders', 'countOrders'));
    }
}
