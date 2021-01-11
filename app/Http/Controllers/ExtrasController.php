<?php

namespace App\Http\Controllers;

use App\Extras;
use Illuminate\Http\Request;

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

        $item = new Extras();
        $item->name = $request->name;
        $item->price = $request->value;

        $item->save();

        return redirect()->route('itensAdicionais.index')->with('msg', 'Item cadastrado com sucesso!');
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
        //
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
