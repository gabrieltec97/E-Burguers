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

    public function login()
    {

        $districts = deliver::all();

        return view('clientUser.clientLogin', compact('districts'));
    }

    public function newClientUser(Request $request)
    {
        $rules = [
            'clientName' => 'required|min:3',
            'clientSurname' => 'required|min:3',
            'clientAdNumber' => 'required',
            'clientNumber' => 'required|min:10',
            'clientAddress' => 'required|min:5',
            'district' => 'required',
            'refPoint' => 'required|min:5',
            'clientEmail' => 'required',
            'clientPassword' => 'required|min:5'
        ];

        $messages = [
            'clientName.required' => 'Por favor, insira seu nome.',
            'clientName.min' => 'Por favor, insira um nome com no mínimo 3 letras.',
            'clientSurname.required' => 'Por favor, insira seu sobrenome.',
            'clientSurname.min' => 'Por favor, insira um sobrenome com no mínimo 3 letras.',
            'refPoint.required' => 'Por favor, insira um ponto de referência com no mínimo 5 letras.',
            'refPoint.min' => 'Por favor, insira o número de identificação da residência.',
            'clientAdNumber.required' => 'Por favor, insira o número de identificação da residência.',
            'clientAddress.required' => 'Por favor, insira seu endereço.',
            'clientAddress.min' => 'Por favor, insira um endereço com no mínimo 5 letras.',
            'clientNumber.required' => 'Por favor, insira seu número de telefone.',
            'clientNumber.min' => 'Por favor, insira um número válido (ddd) + número.',
            'clientEmail.required' => 'Por favor, insira seu e-mail.',
            'clientEmail.min' => 'Por favor, insira um e-mail válido email@provedor.com',
            'clientPassword.required' => 'Por favor, insira sua senha.',
            'clientPassword.min' => 'Por favor, insira uma senha de pelo menos 5 dígitos',
            'district.required' => 'Por favor, selecione o bairro a ser entregue.'
        ];

        $request->validate($rules, $messages);

        $emails = DB::table('users')
            ->select('email')
            ->get()->toArray();


        foreach ($emails as $email){
            if ($request->clientEmail == $email->email){
                return redirect()->back()->withInput()->with('msg-error', 'error');
            }
        }

        return redirect()->back()->with('msg', 'success');
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
            'district' => 'required',
            'adNumber' => 'required',
            'refPoint' => 'required'

        ];

        $messages = [
            'empName.required' => 'Por favor, insira o nome do funcionário',
            'refPoint.required' => 'Por favor, insira o ponto de referência',
            'adNumber.required' => 'Por favor, insira o número de identificação da residência.',
            'empName.min' => 'O nome do funcionário deve conter no mínimo 3 caracteres',
            'empSurname.required' => 'Por favor, insira o sobrenome do funcionário',
            'empSurname.min' => 'O sobrenome do funcionário deve conter no mínimo 5 caracteres',
            'empPhone.required' => 'Insira o número de telefone do funcionário.',
            'empPhone.min' => 'Você inseriu um formato inválido de telefone do funcionário',
            'empAddress.min' => 'Você inseriu um endereço muito curto, caso esteja correto, preencha com xxxx',
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
        $user->adNumber = $request->adNumber;
        $user->refPoint = $request->refPoint;
        $user->district = $request->district;
        $user->email = $request->empEmail;
        $user->password = bcrypt($request->empPassword);

        $user->save();

        return redirect(route('gerenciamento'))->with('msg', $user->id);
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
//        if(!Auth::user()->hasPermissionTo('Gerenciamento de Usuários')){
//            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
//        }

        $rules = [
            'empName' => 'required|min:3',
            'empEmail' => 'required|min:8',
            'empSurname' => 'required|min:3',
            'empPhone' => 'required|min:10',
            'empAddress' => 'required|min:5',
            'district' => 'required',
            'adNumber' => 'required',
            'refPoint' => 'required'

        ];

        $messages = [
            'empName.required' => 'Por favor, insira o nome do corretamente',
            'empEmail.required' => 'Por favor, insira o e-mail do corretamente',
            'empAddress.required' => 'Por favor, insira o endereço do corretamente',
            'refPoint.required' => 'Por favor, insira o ponto de referência',
            'empName.min' => 'O nome deve conter no mínimo 3 caracteres',
            'empSurname.required' => 'Por favor, insira o sobrenome do corretamente',
            'adNumber.required' => 'Por favor, número de identificação da residência',
            'empSurname.min' => 'O sobrenome  deve conter no mínimo 5 caracteres',
            'empEmail.min' => 'O e-mail  deve conter no mínimo 8 caracteres',
            'empPhone.required' => 'Insira o número de telefone do corretamente.',
            'empPhone.min' => 'Você inseriu um formato inválido de telefone.',
            'empAddress.min' => 'Você inseriu um endereço muito curto, caso esteja correto, preencha com xxxx',
            'district.required' => 'Por favor, selecione o bairro a ser entregue.'
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
        $user->refPoint = $request->refPoint;
        $user->adNumber = $request->adNumber;
        $user->district = $request->district;
        $user->email = $request->empEmail;
        $user->save();

        if($request->empSenha != ''){
            $userPassword->password = bcrypt($request->empSenha);
            $userPassword->save();
        }

        if(Auth::user()->hasPermissionTo('Gerenciamento de Usuários')){
            return redirect()->route('usuario.show', $id)->with('msg', 'Dados alterados com sucesso!');
        }else{
            return redirect()->back()->with('msg', 'Dados alterados com sucesso!');
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
