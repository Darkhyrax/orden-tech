<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidacionSesion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {  
        if ($request->session()->has('usuario')) 
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('login');
        }
        
        
    }
}
