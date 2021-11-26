<?php

namespace App\Http\Controllers;

use App\DeliveryMan;
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
                return redirect('cardapio/1');
            }
        }

        $deliveryStatus = DB::table('delivery_status')->select('status')->where('id', '=', 1)->get()->toArray();

        if ($deliveryStatus == null){
            DB::table('delivery_status')
                ->insert(['id' => 1, 'status' => 'Fechado']);
        }

        //Permitindo mostrar as avaliações e inserindo senha de proteção à rota ACL.
        $lock = DB::table('lock_rating')
            ->get()->toArray();

        if (count($lock) == 0){
            DB::table('lock_rating')
                ->insert(
                    ['id'=> 1, 'lock' => "Sim", 'lockAuth' => 'Sim', 'password' => '7sPa)@x%p,aXbzX?E48X\Z=CD']);
        }

        $registered = DB::table('orders')->where('status', '=', 'Pedido registrado')->get()->toArray();
        $prepare = DB::table('orders')->where('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->orWhere('status', '=', 'Pedido registrado')->get()->toArray();
        $total = DB::table('orders')->where('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->get()->toArray();
        $prepareCount = DB::table('orders')->where('status', '=', 'Pronto')->get()->toArray();
        $ready = DB::table('orders')->where('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->get()->toArray();
        $totalReady = DB::table('orders')->where('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->get()->toArray();
        $deliveryStatus = DB::table('delivery_status')->select('status')->where('id', '=', 1)->get()->toArray();
        $deliverMen = DeliveryMan::all();

        return view('home', compact('registered', 'deliverMen', 'deliveryStatus', 'prepare', 'ready', 'prepareCount', 'total', 'totalReady'));
    }

    public function hybridHome()
    {
        //Verificando delivery fechado.
        $close = DB::table('working_time')
            ->where('id', '=', '1')
            ->get()->toArray();

        $deliveryStatus = DB::table('delivery_status')
            ->where('id', '=', 1)
            ->get()->toArray();

        $hour = date('H' . ':' . 'i');

        //Fechando delivery
        if ($close[0]->closeHour <= $hour){

            if ($deliveryStatus[0]->status == 'Aberto'){
                DB::table('delivery_status')
                    ->update(['status' => 'Fechado']);

                DB::table('trays')->truncate();
                DB::table('item_without_extras')->truncate();
            }
        }

        if(!Auth::user()->hasPermissionTo('Pedidos (Híbrido)')){
            return redirect()->route('home');
        }

        $registered = DB::table('orders')->where('status', '=', 'Pedido registrado')->orwhere('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->orWhere('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->get();
        $count = DB::table('orders')->where('status', '=', 'Pedido registrado')->orwhere('status', '=', 'Em preparo')->orWhere('status', '=', 'Pronto')->orWhere('status', '=', 'Em rota de entrega')->orWhere('status', '=', 'Pronto para ser retirado no restaurante')->get();
        $deliveryStatus = DB::table('delivery_status')->select('status')->where('id', '=', 1)->get()->toArray();
        $deliveryMen = DeliveryMan::all();

        return view('hybridHome', compact('registered', 'count', 'deliveryStatus', 'deliveryMen'));
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
