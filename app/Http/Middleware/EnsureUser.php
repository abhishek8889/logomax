<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class EnsureUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  
    public function handle($request, Closure $next)
    {
        if (Auth::check() ) {
            if(Auth::user()->role_id == 2){
                return redirect(url('/designer-dashboard'));
            }
            if(Auth::user()->role_id == 3){
                return redirect(url('/admin-dashboard'));
            }
            if(Auth::user()->role_id == 4){
                return redirect(url('/special-designer/dashboard/'));
            }
        }
        return $next($request);
    }
}
