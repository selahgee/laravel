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
                    return redirect('/admin');
                    break;
                default:
                    return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
