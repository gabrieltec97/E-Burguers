<?php

namespace App\Http\Controllers;

use App\deliver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class loginController extends Controller
{
    public function login()
    {
        $districts = deliver::all();

        return view('clientUser.clientLogin', compact('districts'));
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function resetPassword(Request $request)
    {
        $code = 'RC'. rand(1000, 20000000);

        $check = DB::table('users')
            ->select('name')
            ->where('email', '=', $request->email)
            ->get()->toArray();

        if ($check == null){
            return redirect()->back()->with('msg-error', '.')->withInput();
        }else{
            DB::table('users')
                ->where('email', '=', $request->email)
                ->update(['code' => $code]);

            Mail::send('Mail.reset', ['name' => $check[0]->name], function ($m){
                $m->from('contato@e-pedidosdelivery.online', 'E-Pedidos');
                $m->subject('Redefinição de senha');
                $m->to('gabrielphp20@gmail.com');
            });

            return redirect()->route('insertCode')->with('msg-send', '.');
        }
    }

    public function updatePassword(Request $request)
    {
//        if (strlen($request->code) < 6){
//            return redirect()->back()->with('msg-error', 'Este código não existe, ou foi digitado incorretamente.');
//        }elseif(strlen($request->password) < 5 or strlen($request->confirm) < 5){
//            return redirect()->back()->with('msg-error', 'Você digitou uma senha inválida. Use pelo menos 5 dígitos.');
//        }elseif($request->password != $request->confirm){
//            return redirect()->back()->with('msg-error', 'As senhas não conferem, digite novamente.');
//        }

        $checkEmail = DB::table('users')
            ->select('code')
            ->where('email', '=', $request->email)
            ->get()->toArray();

        if ($checkEmail == null){
            return redirect()->back()->with('msg-error', 'Este e-mail não está cadastrado em nossa base de dados.')->withInput();
        }elseif($checkEmail[0]->code == null){
            return redirect()->back()->with('msg-error', 'Este código não existe, ou foi digitado incorretamente.')->withInput();
        }

        DB::table('users')
            ->where('email', '=', $request->email)
            ->update(['password' => bcrypt($request->password)]);

        return redirect()->route('entrar')->with('msg', 'Senha alterada com sucesso!');
    }
}
