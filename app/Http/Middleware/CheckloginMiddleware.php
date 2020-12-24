<?php

namespace App\Http\Middleware;

use Closure;

class CheckloginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!isset($_COOKIE['UserId'])) return redirect('login');
        setcookie("UserId", $_COOKIE['UserId'], time() + 300);
        return $next($request);
    }
}
