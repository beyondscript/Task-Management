<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectNonWww
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(env('APP_ENV') != 'local'){
            if (!$request->wantsJson() && !preg_match('/^www\./', $request->host())) {
                $wwwUrl = $request->getScheme() . '://www.' . $request->getHost() . $request->getRequestUri();
                return redirect()->to($wwwUrl, 301);
            }
        }
        
        return $next($request);
    }
}
