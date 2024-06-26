<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Clinic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
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
            'clinic_id' => ['required', 'string'],
            'role'      => ['required', 'string', 'min:2'],
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'clinic_id' => $data['clinic_id'],
            'password'  => Hash::make($data['password']),
        ]);

        $user->roles()->attach(Role::where("id", $data["role"])->first());

        return $user;
    }

    public function showRegistrationForm()
    {
        $clinics = Clinic::all();
        $role    = Role::where("slug", "patient")->first()->id;

        return view('adminlte::auth.register', compact(["clinics", "role"]));
    }

    public function showMemberRegistrationForm()
    {
        $clinics = Clinic::all();
        $role    = Role::where("slug", "member")->first()->id;

        return view('adminlte::auth.member-register', compact(["clinics", "role"]));
    }
}
