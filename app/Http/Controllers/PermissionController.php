<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Verificando se o usuário pode acessar esta rota.
        $accessPermission = DB::table('lock_rating')
            ->select('lockAuth')
            ->get()->toArray();

        if (isset($accessPermission[0])){
            if ($accessPermission[0]->lockAuth == 'Sim'){
                return redirect()->route('home');
            }
        }

        $function = Permission::all()->toArray();

        return view('Permissions.permissions', compact('function'));
    }

    public function routeAuth()
    {
        if(!Auth::user()->hasPermissionTo('Gerenciamento de ACL')){
            return redirect()->route('home');
        }

        $status = DB::table('lock_rating')
            ->select('lockAuth')
            ->where('id', '=', 1)
            ->get()->toArray();

        if ($status[0]->lockAuth == 'Não'){
            return redirect()->route('roles.index');
        }

        return view('Permissions.accessAcl');
    }

    public function routeAuthLogin(Request $request)
    {
        $password = DB::table('lock_rating')
            ->select('password')
            ->where('id', '=', 1)
            ->get()->toArray();

        if ($request->password == $password[0]->password){

            DB::table('lock_rating')
                ->where('id', '=', 1)
                ->update(['lockAuth' => 'Não']);

            return redirect()->route('roles.index');

        }else{
            return redirect()->back();
        }
    }

    public function routeAuthLock()
    {
        DB::table('lock_rating')
            ->where('id', '=', 1)
            ->update(['lockAuth' => 'Sim']);

        return redirect()->back();
    }

    public function password()
    {

    }

    public function permissions()
    {
        return view('Permissions.permissions');
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
        $function = new Permission();
        $function->name = $request->function;
        $function->save();

        return redirect()->back()->with('msg', 'Funcionalidade cadastrada com sucesso!');
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
        $function = Permission::find($id);
        $function->name = $request->function;
        $function->save();

        return redirect()->back()->with('msg', 'Funcionalidade editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $function = Permission::find($id);
        $function->destroy($id);

        return redirect()->back()->with('msg-2', 'Funcionalidade deletada com sucesso!');
    }
}
