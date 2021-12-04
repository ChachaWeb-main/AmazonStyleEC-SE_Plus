<?php

namespace App\Http\Middleware;

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
        $redirect_url = '/';
        // 管理者である場合に、/dashboardにリダイレクトさせる。
        if ($guard == 'admins') {
           $redirect_url = '/dashboard';
        }
        
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }
        
        return $next($request);
    }
}
