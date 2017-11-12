<?php

namespace Infocentro\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Infocentro\Http\Controllers\Controller;
use Infocentro\User;
use Intervention\Image\Image;

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
    protected $redirectTo = '/';

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
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6|confirmed',
            'pregunta'  => 'required',
            'respuesta' => 'required',
            'avatar'    => 'mimes:jpeg,bmp,png'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'pregunta'  => $data['pregunta'],
            'respuesta' => $data['respuesta'],
            'avatar'    => (empty($data['avatar'])) ? 'avatar_default.png' : $this->avatar($data['avatar'])
        ]);
    }

    protected function avatar($img)
    {
        if ($img) {
            $name = 'avatar_' . time() . '.' . $img->getClientOriginalExtension();
            $path = public_path('img/avatar/' . $name);
            \Image::make($img)->resize(200, 200)->save($path);
        }
        return $name;
    }
}
