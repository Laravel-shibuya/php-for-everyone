<?php

namespace App\Http\Controllers\Auth;

use App\Eloquent\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'screen_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255', 'regex:/\A[a-zA-Z0-9_-]+\z/', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:64', 'confirmed'],
            'profile' => ['nullable', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Eloquent\User
     */
    protected function create(array $data)
    {
        return User::create([
            'screen_name' => $data['screen_name'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'profile' => $data['profile'] ?: '',
        ]);
    }
}
