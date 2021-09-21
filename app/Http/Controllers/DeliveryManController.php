<?php

namespace App\Http\Controllers;

use App\deliver;
use App\DeliveryMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryManController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveryMen = DeliveryMan::all();

        return view('Deliver.deliveryman', compact('deliveryMen'));
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
            'name' => 'required|min:5|max:45'
        ];

        $messages = [
            'name.required' => 'Por favor, insira o nome do entregador',
            'name.min' => 'O nome do entregador deve conter no mínimo 5 caracteres',
            'name.max' => 'O nome do entregador não pode ter mais de 45 caracteres'
        ];

        $request->validate($rules, $messages);

        $check = DeliveryMan::all();

        foreach ($check as $key => $value){
            if ($request->name == $value->name){
                return redirect()->back()->with('msg-2', '.');
            }
        }

        $deliver = new DeliveryMan();
        $deliver->name = $request->name;
        $deliver->save();

        return redirect()->back()->with('msg', '.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deliveryMan = DeliveryMan::find($id);
        $districts = deliver::all();
        $count = array();

        if ($deliveryMan == null){
            return redirect()->back();
        }

        foreach ($districts as $key => $value){
            $delivers = DB::table('orders')
                ->select('id')
                ->whereRaw("deliverMan = '". $deliveryMan->name. "' and status = 'Pedido entregue' and district = '". $value->name. "'")
                ->get()->toArray();

            array_push($count, [1 => $value->name, 2 => count($delivers)]);
        }

        return view('Deliver.deliverManDelivers', compact('deliveryMan', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (strlen($request->name) < 5 or strlen($request->name) > 45){
            return redirect()->back()->with('msg-7', '.');
        }

        $check = DeliveryMan::all();

        foreach ($check as $key => $value){
            if ($request->name == $value->name){
                if ($id != $value->id){
                    return redirect()->back()->with('msg-4', '.');
                }else{
                    return redirect()->back()->with('msg-6', '.');
                }
            }
        }

        $data = DeliveryMan::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->back()->with('msg-5', '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DeliveryMan::find($id);
        $data->delete();

        return redirect()->back()->with('msg-3', '.');
    }
}
