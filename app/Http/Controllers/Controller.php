<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $role = auth()->user()->role;

        if ($role === 'patient') {
            return redirect()->route('patient.dashboard');
        } elseif ($role === 'driver') {
            return redirect()->route('driver.dashboard');
        } elseif ($role === 'admin') {
            return redirect()->route('admin.index');
        }

        // Default redirect if role is not recognized
        return redirect('/');
    }

    public function showLoginForm()
    {
        $roles = Role::all(); // Assuming you have a Role model

        return view('your_login_blade_view', compact('roles'));
    }
}
