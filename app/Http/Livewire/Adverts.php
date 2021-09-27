<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Adverts extends Component
{
    use WithPagination;
    public function render()
    {
        $meals = DB::table('adverts')->paginate(12);
        return view('livewire.adverts', compact('meals'));
    }
}
