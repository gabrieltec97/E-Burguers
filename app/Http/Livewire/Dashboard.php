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
        $items = DB::table('adverts')
            ->orderBy('totalSale', 'desc')
            ->paginate(8);

        return view('livewire.dashboard', compact('items'));
    }
}
