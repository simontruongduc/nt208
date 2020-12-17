<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (url('auth/login') == URL::current() || url('auth/signin') == URL::current()) {
                return redirect('/index');
            }

            return $next($request);
        } else {
            if (url('auth/login') == URL::current() || url('auth/signin') == URL::current()) {
                return $next($request);
            }
            $backUrl = URL::current();

            return redirect('auth/login')->with('backUrl', $backUrl);
        }
    }
}
