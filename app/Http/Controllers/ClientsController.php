<?php

namespace App\Http\Controllers;

use App\deliver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return view('Clients.clients');
    }

    public function myData()
    {
        if (Auth::user()->hasPermissionTo('Pedidos (Comum)') or Auth::user()->hasPermissionTo('Pedidos (Híbrido)') or Auth::user()->hasPermissionTo('Em Preparo')){

            if (Auth::user()->hasPermissionTo('Dashboard')){
                $user = 'administrador';
            }else{
                $user = 'funcionario';
            }
        }else{
            $user = 'cliente';
        }

        $data = Auth::user()->toArray();
        $neighboor = deliver::all();

        return view('clientUser.clientData', compact('user', 'data', 'neighboor'));
    }


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
        //
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
        //
    }
}
