<?php

namespace App\Http\Controllers;

use App\deliver;
use App\DeliveryMan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliveryManController extends Controller
{
    public function orders()
    {
        $user = DB::table('users')
            ->select('name', 'surname')
            ->where('id', '=', Auth::user()->id)
            ->get()->toArray();

        $user = $user[0]->name . ' ' . $user[0]->surname;

        $registered = DB::table('orders')
            ->where('status', '=', 'Em rota de entrega')
            ->where('deliverMan', 'like', '%'.$user . '%')
            ->get();

        $count = DB::table('orders')
            ->where('status', '=', 'Em rota de entrega')
            ->where('deliverMan', 'like', '%'.$user . '%')
            ->get();

        return view('Deliver.deliverOrders', compact('registered', 'count'));
    }
}
