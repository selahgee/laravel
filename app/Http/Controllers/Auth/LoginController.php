<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AmbulanceController;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.welcome');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember_me'))) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect()->back()->withInput($request->only('email'));
    }

    protected function authenticated(Request $request, $user)
    {
        switch ($user->role) {
            case 'patient':
                return redirect()->route('ambulance.booking.form');
                break;

            case 'driver':
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;

            default:
                return redirect()->route('register'); // Redirect to registration page if role is not defined
        }
    }
}
