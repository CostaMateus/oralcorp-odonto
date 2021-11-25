<?php

namespace App\Http\Controllers\Auth;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $clinics = Clinic::all();
        return view('adminlte::auth.login', compact(["clinics"]));
    }

    public function authenticated(Request $request)
    {
        Auth::logoutOtherDevices($request->email);
    }

    public function login(Request $request)
    {
        $message = [
            'clinic_id.required' => 'O campo unidade é obrigatório.',
        ];

        $credentials = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required'],
            'clinic_id' => ['required'],
        ], $message);

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect()->intended('');
        }

        return back()->withErrors([
            'email' => 'Essas credenciais não foram encontradas em nossos registros.',
        ]);
    }
}
