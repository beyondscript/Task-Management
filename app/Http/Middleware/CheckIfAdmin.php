<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->expectsJson()) {
            if(Auth::check()){
                if(Auth::user()->type == 'admin'){
                    return $next($request);
                }
                else{
                    return response()->json([
                        'message' => 'You are not allowed to perform this action'
                    ],403);
                }
            }
            else{
                return response()->json([
                    'message' => 'Unauthenticated'
                ],401);
            }
        }

        $notification = array(
            'message' => 'You are not allowed to perform this action',
            'alert-type' => 'info'
        );

        if(Auth::user()->type == 'admin'){
            return $next($request);
        }
        else if(Auth::user()->type == 'supervisor'){
            if(Auth::user()->revoked == false){
                return redirect()->route('supervisorHome')->with($notification);
            }
            else if(Auth::user()->revoked == true){
                return redirect()->route('revokedSupervisorHome')->with($notification);
            }
        }
        else if(Auth::user()->type == 'stuff'){
            return redirect()->route('home')->with($notification);
        }
    }
}
