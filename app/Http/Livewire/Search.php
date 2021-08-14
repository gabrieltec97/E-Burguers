<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $orders = DB::table('orders')
            ->where('id', 'like', '%'.  $this->search. '%')
            ->orWhere('day', 'like', '%'.  $this->search. '%')
            ->orWhere('clientName', 'like', '%'.  $this->search. '%')
            ->orWhere('deliverWay', 'like', '%'.  $this->search. '%')
            ->orWhere('payingMethod', 'like', '%'.  $this->search. '%')
            ->orWhere('status', 'like', '%'.  $this->search. '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.search', compact('orders'));
    }
}
