<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $role = auth()->user()->role;

            switch ($role) {
                case 'admin':
                    return redirect('/admin.dashboard1');
                    break;
                    case 'patient':
                    return redirect('/ambulance.booking.form');
                    break;
                    case 'driver':
                    return redirect('/driver.CRUD.index');
                    break;
                default:
                    return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
