<?php

namespace App\Http\Controllers;

use App\Extras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Extras::all();

        return view('adverts.Extras.management', compact('items'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $rules = [
//            'nome' => 'required',
//            'value' => 'required|min:3|max:5'
//        ];
//
//        $messages = [
//            'name.required' => 'Por favor, insira o nome do item.',
//            'name.min' => 'O nome do item deve conter no mínimo 4 caracteres.',
//            'name.max' => 'O nome do item deve conter no máximo 50 caracteres.',
//            'value.required' => 'Por favor, insira o valor do item.',
//            'value.min' => 'O valor do item deve conter apenas 5 caracteres.',
//            'value.max' => 'O valor do item deve conter apenas 5 caracteres.'
//        ];
//
//        $request->validate($rules, $messages);

        $items = DB::table('extras')->select('name')->get();

        foreach ($items as $key){
            foreach ($key as $item) {
                if ($item == $request->name){
                   return back()->with('msg-2', 'Item não cadastrado. Já existe um item com o nome "'. $request->name . '". Por favor escolha outro nome.');
                }
            }
        }

        $valor = $request->value;

        $item = new Extras();
        $item->name = $request->name;

        if ($valor[0] == 0){
            $valor2 = substr($valor, 1);
            $item->price = $valor2;
            $item->namePrice = $request->name . ' + ' . $valor2;
        }else{
            $item->price = $request->value;
            $item->namePrice = $request->name . ' + ' . $request->value;
        }

        $item->save();

        return redirect()->route('itensAdicionais.index')->with('msg', 'Item cadastrado com sucesso!');
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
        $item = Extras::find($id);

        $item->name = $request->name;
        $item->price = $request->price;
        $item->save();

        return redirect()->route('itensAdicionais.index')->with('msg', 'Item editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Extras::find($id);

        $item->destroy($id);

        return redirect()->route('itensAdicionais.index')->with('msg-2', 'Item deletado com sucesso!');
    }
}
