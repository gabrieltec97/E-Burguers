<?php

namespace App\Http\Controllers;

use App\deliver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ClientsController extends Controller
{

    public function myData()
    {
        if (Auth::user()->hasPermissionTo('Pedidos (Comum)') or Auth::user()->hasPermissionTo('Pedidos (Híbrido)')){

            if (Auth::user()->hasPermissionTo('Dashboard')){
                $user = 'administrador';
            }else{
                $user = 'funcionario';
            }
        }else{
            $user = 'cliente';
        }

        $data = Auth::user()->toArray();
        $neighboor = deliver::all();

        return view('clientUser.clientData', compact('user', 'data', 'neighboor'));
    }
}
