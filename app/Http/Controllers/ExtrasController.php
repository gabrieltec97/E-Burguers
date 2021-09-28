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
        $rules = [
            'name' => 'required|min:4|max:30',
            'value' => 'required|min:4|max:6'
        ];

        $messages = [
            'name.required' => 'Por favor, insira o nome do item.',
            'name.min' => 'O nome do item deve conter no mínimo 4 caracteres.',
            'name.max' => 'O nome do item deve conter no máximo 30 caracteres.',
            'value.required' => 'Por favor, insira o valor do item.',
            'value.min' => 'O valor do item deve conter no mínimo 3 caracteres.',
            'value.max' => 'O valor do item deve conter no máximo 5 caracteres.'
        ];

        $request->validate($rules, $messages);

        $items = DB::table('extras')->select('name')->get();

        foreach ($items as $key){
            foreach ($key as $item) {
                if ($item == $request->name){
                   return back()->with('msg-2', 'Item não cadastrado. Já existe um item com este nome.');
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
        if (strlen($request->name) < 4){
            return redirect()->back()->with('msg-error', 'Insira um nome com pelo menos 4 caracteres.');
        }

        if (strlen($request->price) < 4){
            return redirect()->back()->with('msg-error', 'Você inseriu um valor inválido!');
        }

        $items = Extras::all();

        foreach ($items as $item => $value){
            if ($value->name == $request->name && $value->id != $id){
                    return back()->with('msg-3', 'Item não alterado. Já existe um item com este nome.');
            }
        }

        $valor = $request->price;
        $item = Extras::find($id);

        $item->name = $request->name;

        if ($valor[0] == 0){
            $valor2 = substr($valor, 1);
            $item->price = $valor2;
            $item->namePrice = $request->name . ' + ' . $valor2;
        }else{
            $item->price = $request->price;
            $item->namePrice = $request->name . ' + ' . $request->price;
        }

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
