<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->type == 'admin'){
                return redirect()->route('adminHome');
            }
            else if(Auth::user()->type == 'supervisor'){
                return redirect()->route('supervisorHome');
            }
            else if(Auth::user()->type == 'stuff'){
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
