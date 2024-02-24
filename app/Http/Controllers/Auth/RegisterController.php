<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $roles = ['patient' => 'Patient', 'driver' => 'Driver', 'admin' => 'Admin'];
        return view('auth.register', compact('roles'));
        // Make sure the view file is in resources/views/auth/register.blade.php
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:patient,driver,admin'],
        ]);
    }

    protected function create(array $data)
    {
        try {
            $this->validator($data)->validate();
    
            // Set a default role if not provided in the registration form
            $role = $data['role'] ?? 'patient';
    
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $role, // Assign the selected role
            ]);
        } catch (\Exception $e) {
            // Log or display the error
            dd($e->getMessage());
        }
    }
}
