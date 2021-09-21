<?php

namespace App\Http\Controllers;

use App\deliver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;

class deliverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Áreas de entrega')){
            return redirect()->back();
        }

        $places = deliver::all();

        return view('Deliver.deliverManagement', compact('places'));
    }

    public function deliveryStatus()
    {
        if(!Auth::user()->hasPermissionTo('Delivery')){
            return redirect()->route('home');
        }

        $status = DB::table('delivery_status')
            ->select('status', 'message')
            ->where('id', '=', 1)
            ->get()->toArray();

        return view('Deliver.deliveryStatus', compact('status'));
    }

    public function changeStatus(Request $request)
    {
        $status = DB::table('delivery_status')
            ->select('status')
            ->where('id', '=', 1)
            ->get()->toArray();

        if($status[0]->status == 'Fechado'){
            $status = 'Aberto';
        }else{
            $status = 'Fechado';
        }

        DB::table('delivery_status')
            ->update(['status' => $status, 'message' => $request->feedback]);

        return redirect()->back()->with('msg', '.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'bairro' => 'required',
            'taxa' => 'required|min:3'
        ];

        $messages = [
            'bairro.required' => 'Por favor, insira o nome do bairro',
            'taxa.required' => 'Por favor, insira o valor da taxa',
            'taxa.min' => 'O valor da taxa deve conter no mínimo 3 números.',
        ];

        $request->validate($rules, $messages);

        $check = DB::table('delivers')
            ->where('name', '=', $request->bairro)
            ->get()->toArray();

        if ($check == null){

            $deliver = new deliver();
            $deliver->name = ucwords($request->bairro);
            $deliver->price = $request->taxa;
            $deliver->save();

            return redirect()->back()->with('msg', '.');
        }else{

            return redirect()->back()->with('msg-2', '.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editStatus(Request $request)
    {
        DB::table('delivery_status')
            ->where('id', '=', 1)
            ->update(['message' => $request->feedback]);

        return redirect()->back()->with('msg-2', '.');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $check = DB::table('delivers')
            ->where('name', '=', $request->bairro)
            ->get()->toArray();

        //Verificando verificação para evitar duplicidade de registros.
        if ($check != null){
            if ($request->bairro == '' or $request->taxa == '' or strlen($request->taxa) < 3 ){
                return redirect()->back()->with('msg-4', '.');

            }elseif ($id == $check[0]->id ){
                if ($check[0]->name == $request->bairro and $check[0]->price == $request->taxa){
                    return redirect()->back()->with('msg-6', '.');

                }else{
                    $place = deliver::find($id);
                    $place->name = ucwords($request->bairro);
                    $place->price = $request->taxa;
                    $place->save();

                    return redirect()->back()->with('msg-5', '.');
                }
            }elseif($check[0]->name == $request->bairro && $id != $check[0]->id){
                return redirect()->back()->with('msg-7', '.');
            }
        }else{
            $place = deliver::find($id);
            $place->name = ucwords($request->bairro);
            $place->price = $request->taxa;
            $place->save();

            return redirect()->back()->with('msg-5', '.');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = deliver::find($id);
        $place->delete();

        return redirect()->back()->with('msg-3', '.');
    }
}
