<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard()->check()) {
            return redirect('/admin/dashboard');
        }

        if (Auth::guard('direktur')->check()) {
            return redirect('/direktur/dashboard');
        }

        if (Auth::guard('rm')->check()) {
            return redirect('/rm/dashboard');
        }

        if (Auth::guard('farmasi')->check()) {
            return redirect('/farmasi/dashboard');
        }

        if (Auth::guard('kantor')->check()) {
            return redirect('/kantor/dashboard');
        }

        if (Auth::guard('keuangan')->check()) {
            return redirect('/keuangan/dashboard');
        }

        if (Auth::guard('kebidanan')->check()) {
            return redirect('/kebidanan/dashboard');
        }

        if (Auth::guard('other_role')->check()) {
            return redirect('/other_role/dashboard');
        }

        return $next($request);
    }
}
