<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Rating extends Component
{
    use WithPagination;
    public function render()
    {
        $rating = DB::table('ratings')->paginate(10);

        return view('livewire.rating', compact('rating'));
    }
}
