<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $user = Auth::user();

            if ($user && property_exists($user, 'role')) {
                switch ($user->role) {
                    case 'patient':
                    case 'driver':
                        return redirect()->route('dashboard');
                        break;

                    case 'admin':
                        return redirect()->route('admin.dashboard');
                        break;

                    default:
                        return redirect()->route('register'); // Redirect to registration page if role is not defined
                }
            } else {
                // If the user's role is not defined, redirect to the registration page
                return redirect()->route('register');
            }
        }

        return redirect()->back()->withInput($request->only('email'));
    }
}
