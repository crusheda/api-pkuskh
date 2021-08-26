<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Route::is('admin.*')){
                return route('view.login.admin');
            }
            elseif(Route::is('direktur.*')){
                return route('view.login.direktur');
            }
            elseif(Route::is('rm.*')){
                return route('view.login.rm');
            }
            elseif(Route::is('farmasi.*')){
                return route('view.login.farmasi');
            }
            elseif(Route::is('kantor.*')){
                return route('view.login.kantor');
            }
            elseif(Route::is('keuangan.*')){
                return route('view.login.keuangan');
            }
            elseif(Route::is('kebidanan.*')){
                return route('view.login.kebidanan');
            }
            else {
                return route('view.login.other.role');
            }
        }
    }
}
