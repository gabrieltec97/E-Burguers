<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;
    public $name;
    public function render()
    {
        $orders = DB::table('orders')
            ->where('id', 'like', '%'.  $this->name. '%')
            ->orWhere('day', 'like', '%'.  $this->name. '%')
            ->orWhere('clientName', 'like', '%'.  $this->name. '%')
            ->orWhere('deliverWay', 'like', '%'.  $this->name. '%')
            ->orWhere('payingMethod', 'like', '%'.  $this->name. '%')
            ->orWhere('status', 'like', '%'.  $this->name. '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.search', compact('orders'));
    }
}
