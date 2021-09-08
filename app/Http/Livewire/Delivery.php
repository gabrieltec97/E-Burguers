<?php

namespace App\Http\Livewire;

use App\deliver;
use Livewire\Component;
use Livewire\WithPagination;

class Delivery extends Component
{
    use WithPagination;

    public function render()
    {
        $places = deliver::paginate(6);

        return view('livewire.delivery', compact('places'));
    }
}
