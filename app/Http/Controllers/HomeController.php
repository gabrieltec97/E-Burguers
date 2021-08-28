<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        if(!Auth::user()->hasPermissionTo('Pedidos (Comum)')){

            $role = Auth::user()->toArray();

            if (isset($role['roles'][0])){
                $role = $role['roles'][0]['name'];

                if ($role == 'Atendente Híbrido'){
                    return redirect()->route('hybridHome');
                }elseif('Cozinheiro'){
                    return redirect()->route('emPreparo');
                }else{
                    throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
                }
            }else{
                throw new UnauthorizedException('403', 'Sua conta não possui um perfil de usuário. Contate o administrador para que seja configurado um perfil em sua conta.');
            }


        }

        $registered = DB::table('orders')->where('status', '=', 'Pedido registrado')->paginate(10);
        $prepare = DB::table('orders')->where('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->orWhere('status', '=', 'Pedido registrado')->simplePaginate(9);
        $total = DB::table('orders')->where('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->get()->toArray();
        $prepareCount = DB::table('orders')->where('status', '=', 'Pronto')->get()->toArray();
        $ready = DB::table('orders')->where('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->simplePaginate(10);
        $totalReady = DB::table('orders')->where('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->get()->toArray();

        return view('home', compact('registered', 'prepare', 'ready', 'prepareCount', 'total', 'totalReady'));
    }

    public function hybridHome()
    {
        if(!Auth::user()->hasPermissionTo('Pedidos (Híbrido)')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $registered = DB::table('orders')->where('status', '=', 'Pedido registrado')->orwhere('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->orWhere('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->paginate(10);
        $count = DB::table('orders')->where('status', '=', 'Pedido registrado')->orwhere('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->orWhere('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->get();

        return view('hybridHome', compact('registered', 'count'));
    }

    public function getData()
    {
        $data = DB::table('orders')->select('id', 'hour', 'status')->where('status', '=', 'Pedido registrado')->get()->toArray();

        return $data;
    }

    public function hybrid()
    {
        $hybridData = DB::table('orders')->select('id', 'hour', 'status')
            ->whereRaw("status <> 'Cancelado' and status <> 'Pedido Entregue' and status <> 'Pendente'")
            ->get()->toArray();

        return $hybridData;
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
