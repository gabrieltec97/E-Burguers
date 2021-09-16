<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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

        $roles = Role::all()->toArray();

        return view('auth.roles.index', compact('roles'));
    }

    public function permissions($role)
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

       $role = Role::where('id', $role)->first();
       $permissions = Permission::all();

       foreach ($permissions as $permission){
           if ($role->hasPermissionTo($permission->name)){
                $permission->can = true;
           }else{
               $permission->can = false;
           }
       }

       return view('roles.permissions', [
           'role' => $role,
           'permissions' => $permissions
       ]);
    }

    public function permissionsSync(Request $request, $role)
    {
        $permissionsRequest = $request->except(['_token', '_method']);

        foreach ($permissionsRequest as $key => $value){
            $permissions[] = Permission::where('id', $key)->first();
        }

        $role = Role::where('id', $role)->first();

        if (!empty($permissions)){

            $role->syncPermissions($permissions);
        }else{
            $role->syncPermissions(null);
        }

        return redirect()->route('rolePermissions', ['role' => $role->id]);
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
        $profile = new Role();
        $profile->name = $request->profile;
        $profile->save();

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
        $role = Role::find($id);
        $role->name = $request->profile;
        $role->save();

        return redirect()->back()->with('msg', 'Perfil editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->destroy($id);

        return redirect()->back()->with('msg-2', 'Perfil deletado com sucesso!');
    }
}
