<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $registered = DB::table('orders')->where('status', '=', 'Pedido registrado')->paginate(10);
        $prepare = DB::table('orders')->where('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->simplePaginate(2);
        $total = DB::table('orders')->where('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->get()->toArray();
        $prepareCount = DB::table('orders')->where('status', '=', 'Pronto')->get()->toArray();
        $ready = DB::table('orders')->where('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->simplePaginate(2);
        $totalReady = DB::table('orders')->where('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->get()->toArray();

        return view('home', compact('registered', 'prepare', 'ready', 'prepareCount', 'total', 'totalReady'));
    }

    public function getData()
    {
        $data = DB::table('orders')->select('id', 'hour', 'status')->where('status', '=', 'Pedido registrado')->get()->toArray();

        return $data;
    }

    public function getPrepare()
    {
        $prepare = DB::table('orders')->select('id', 'hour', 'status')->where('status', '=', 'Pronto')->orWhere('status', '=', 'Em preparo')->get()->toArray();

        return $prepare;
    }

    public function getKitchen()
    {
        $prepareKitchen = DB::table('orders')->select('id', 'hour', 'status')->where('status', '=', 'Em preparo')->orWhere('status', '=', 'Em preparo')->get()->toArray();

        return $prepareKitchen;
    }
}
