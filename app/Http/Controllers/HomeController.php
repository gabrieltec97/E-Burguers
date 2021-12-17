<?php

namespace App\Http\Controllers;

use App\DeliveryMan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //Envio de notificações.
    public function saveToken(Request $request)
    {
        DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->update(['device_token'=>$request->tokenButton]);

        return redirect()->back();
    }

    public function sendNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAHIi2o5k:APA91bHdaXkFScDzR2XLGOoaOBXiAFmzbQ5rmbZ7mkl4MQ3X5WLERQoT_qwQconUBPAEFtjLnk92o_RqpXnbAIDiZEEUpIJ9XKL2NFBHXivrixLuZaT-gZ0XLfWe5t2k9IDoS9VVnlF-';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'Novo pedido',
                "body" => 'Você tem um novo pedido!',
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return redirect()->back();
    }

    public function sendDeliverNotification()
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAHIi2o5k:APA91bHdaXkFScDzR2XLGOoaOBXiAFmzbQ5rmbZ7mkl4MQ3X5WLERQoT_qwQconUBPAEFtjLnk92o_RqpXnbAIDiZEEUpIJ9XKL2NFBHXivrixLuZaT-gZ0XLfWe5t2k9IDoS9VVnlF-';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'Nova entrega a fazer.',
                "body" => 'Você tem um novo pedido para entrega!',
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return redirect()->back();
    }

    public function sendCancelNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAAHIi2o5k:APA91bHdaXkFScDzR2XLGOoaOBXiAFmzbQ5rmbZ7mkl4MQ3X5WLERQoT_qwQconUBPAEFtjLnk92o_RqpXnbAIDiZEEUpIJ9XKL2NFBHXivrixLuZaT-gZ0XLfWe5t2k9IDoS9VVnlF-';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'Ei, temos uma alteração de pedido.',
                "body" => 'Veja na aba de informações se o pedido foi entregue ou cancelado.',
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return redirect()->back();
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

                    if ($role == 'Atendente Híbrido' or $role == 'Administrador'){
                    return redirect()->route('hybridHome');
                }elseif($role == 'Cozinheiro'){
                    return redirect()->route('emPreparo');
                }elseif($role == 'Entregador'){
                        return redirect()->route('entregas');
                }else{
                    throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
                }
            }else{
                return redirect('cardapio/1');
            }
        }

        return redirect()->back();
    }

    public function hybridHome()
    {
        //Verificando delivery fechado.
        $close = DB::table('working_time')
            ->where('id', '=', '1')
            ->get()->toArray();

        if ($close == null){
            DB::table('working_time')
                ->insert(['closeHour' => '00:00', 'id' => '1']);
        }

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

        //Capturando dados dos entregadores
        $roleId = DB::table('roles')
            ->select('id')
            ->where('name', '=', 'Entregador')
            ->get()->toArray();

        $userIds = DB::table('model_has_roles')
            ->select('model_id')
            ->where('role_id', '=', $roleId[0]->id)
            ->get()->toArray();

        $deliveryMen = array();

        foreach ($userIds as $u => $user){
            $delivery = DB::table('users')
                ->select('name', 'surname', 'id')
                ->where('id', '=', $user->model_id)
                ->get()->toArray();

            array_push($deliveryMen, $delivery);
        }

        $registrado = DB::table('orders')->select('id')->where('status', '=', 'Pedido registrado')->get()->toArray();

        return view('hybridHome', compact('registered', 'count', 'deliveryStatus', 'deliveryMen', 'registrado'));
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

    public function deliverTaking()
    {
        $user = DB::table('users')
            ->select('name', 'surname')
            ->where('id', '=', Auth::user()->id)
            ->get()->toArray();

        $user = $user[0]->name . ' ' . $user[0]->surname;

        $deliverData = DB::table('orders')->select('id', 'hour', 'status')
            ->where('status', '=', 'Em rota de entrega')
            ->where('deliverMan', 'like', '%'.$user . '%')
            ->get()->toArray();

        return $deliverData;
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
