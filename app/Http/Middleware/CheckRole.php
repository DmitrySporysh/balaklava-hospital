<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
       
        if(Auth::guest())
        {
            return redirect('/');
        }
        if ((Auth::user()->role != $role)) {
            return new Response(view('/errors/authenticationError'));
        }
        

        return $next($request);
    }
}
