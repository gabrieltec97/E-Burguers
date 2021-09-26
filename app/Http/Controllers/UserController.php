<?php

namespace App\Http\Controllers;

use App\deliver;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->email;
        $myUser = DB::table('users')
            ->where('email', '=', $user)
            ->get()->toArray();

        return view('User.user', compact('myUser'));
    }

    public function management()
    {
//        if(!Auth::user()->hasPermissionTo('Gerenciamento de Usuários')){
//            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
//        }

        //Permitindo mostrar as avaliações e inserindo senha de proteção à rota ACL.
        $lock = DB::table('lock_rating')
            ->get()->toArray();

        if (count($lock) == 0){
            DB::table('lock_rating')
                ->insert(
                    ['id'=> 1, 'lock' => "Sim", 'lockAuth' => 'Sim', 'password' => '7sPa)@x%p,aXbzX?E48X\Z=CD']);
        }

        $employees = User::all();

        return view('User.management', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function roles($user)
    {
        $user = User::where('id', $user)->first();

        $roles = Role::all();

        foreach ($roles as $role){
            if ($user->hasRole($role->name)){
                $role->can = true;
            }else{
                $role->can = false;
            }
        }

        return view('user.roles', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function rolesSync(Request $request, $user)
    {
        $rolesRequest = $request->except(['_token', '_method']);

        foreach ($rolesRequest as $key => $value){
            $roles[] = Role::where('id', $key)->first();
        }

        $user = User::where('id', $user)->first();

        if (!empty($roles)){

            $user->syncRoles($roles);
        }else{
            $user->syncRoles(null);
        }

        return redirect()->route('userRoles', ['user' => $user->id]);
    }


    public function create()
    {
        if(!Auth::user()->hasPermissionTo('Gerenciamento de Usuários')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $places = deliver::all();

        return view('User.newEmployee', compact('places'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciamento de Usuários')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $rules = [
            'empName' => 'required|min:3',
            'empSurname' => 'required|min:3',
            'empPhone' => 'required|min:10',
            'empAddress' => 'required|min:5',
            'empWorkingTime' => 'required',
            'district' => 'required'

        ];

        $messages = [
            'empName.required' => 'Por favor, insira o nome do funcionário',
            'empName.min' => 'O nome do funcionário deve conter no mínimo 3 caracteres',
            'empSurname.required' => 'Por favor, insira o sobrenome do funcionário',
            'empSurname.min' => 'O sobrenome do funcionário deve conter no mínimo 5 caracteres',
            'empPhone.required' => 'Insira o número de telefone do funcionário.',
            'empPhone.min' => 'Você inseriu um formato inválido de telefone do funcionário',
            'empAddress.min' => 'Você inseriu um endereço muito curto, caso esteja correto, preencha com xxxx',
            'empWorkingTime.required' => 'Por favor, insira o horário de trabalho do funcionário',
            'district.required' => 'Por favor, selecione o bairro a ser entregue.'
        ];

        $request->validate($rules, $messages);

        $checkEmail = User::all();

        foreach ($checkEmail as $e => $value){
            if ($value->email == $request->empEmail){
                return redirect()->back()->withInput()->with('msg-error', '.');
            }
        }


        $user = new User();

        $user->name = $request->empName;
        $user->surname = $request->empSurname;
        $user->phone = $request->empPhone;
        $user->fixedPhone = $request->empFixedPhone;
        $user->address = $request->empAddress;
        $user->district = $request->district;
        $user->workingTime = $request->empWorkingTime;
        $user->email = $request->empEmail;
        $user->password = bcrypt($request->empPassword);

        $user->save();

        return redirect(route('gerenciamento'))->with('msg', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciamento de Usuários')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $user = User::find($id)->toArray();

        return view('User.userData', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciamento de Usuários')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $user = User::find($id);
        $places = deliver::all();

        return view('User.employeeEdit', compact('user', 'places'));
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
        if(!Auth::user()->hasPermissionTo('Gerenciamento de Usuários')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $rules = [
            'empName' => 'required|min:3',
            'empSurname' => 'required|min:5',
            'empAddress' => 'required|min:5',
            'empPhone' => 'required|min:10',
            'empWorkingTime' => 'required|min:12',
        ];

        $messages = [
            'empName.required' => 'Por favor, insira o nome do funcionário.',
            'empSurname.required' => 'Por favor, insira o sobrenome do funcionário.',
            'empSurname.min' => 'O sobrenome do funcionário deve conter no mínimo 5 caracteres.',
            'empName.min' => 'O nome do funcionário deve conter no mínimo 4 caracteres.',
            'empAddress.min' => 'O endereço do funcionário deve conter no mínimo 4 caracteres.',
            'empAddress.required' => 'Por favor, insira o endereço do funcionário.',
            'empPhone.required' => 'Por favor, insira o número de contato.',
            'empPhone.min' => 'Por favor, insira um número válido.',
            'empWorkingTime.required' => 'Por favor, insira o horário de trabalho do funcionário.',
            'empWorkingTime.min' => 'Por favor, insira um horário de trabalho correto.'
        ];

        $request->validate($rules, $messages);

        $user = User::find($id);
        $passChange = DB::table('users')->where('email', '=', $user->email)->get()->toArray();

        if( $passChange != null){
            $userPassword = User::find($passChange[0]->id);
        }

        $user->name = $request->empName;
        $user->surname = $request->empSurname;
        $user->phone = $request->empPhone;
        $user->fixedPhone = $request->empFixedPhone;
        $user->address = $request->empAddress;
        $user->workingTime = $request->empWorkingTime;
        $user->district = $request->district;
        $user->email = $request->empEmail;
        $user->save();

        if($request->empSenha != ''){
            $userPassword->password = bcrypt($request->empSenha);
            $userPassword->save();
        }

        return redirect()->route('usuario.show', $id)->with('msg', 'Dados alterados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('Gerenciamento de Usuários')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        if ($id == Auth::user()->id){
            return redirect()->route('gerenciamento')->with('msg-not', 'Contate o administrador caso queira deletar seu próprio login de usuário.');
        }

        $userDelete = User::find($id);
        $userDelete->delete();


        return redirect(route('gerenciamento'))->with('msg-2', 'Registro deletado com sucesso!');
    }
}
