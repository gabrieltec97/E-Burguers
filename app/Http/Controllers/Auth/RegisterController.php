<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3'],
            'address' => ['required', 'string', 'min:5'],
            'adNumber' => ['required', 'int'],
            'refPoint' => ['required', 'string', 'min:5'],
            'phone' => ['required', 'string', 'min:10', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'min:8', 'unique:users'],
            'password' => ['required', 'string', 'min:5'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $reqData = explode(" ", $data['name']);
        $name = $reqData[0];
        unset($reqData[0]);
        $reqData = implode(" ", $reqData);

        return User::create([
            'name' => $name,
            'surname' => $reqData,
            'phone' => $data['phone'],
            'address' => $data['address'],
            'district' => $data['district'],
            'refPoint' => $data['refPoint'],
            'adNumber' => $data['adNumber'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
