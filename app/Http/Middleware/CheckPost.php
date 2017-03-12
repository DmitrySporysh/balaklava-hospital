<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class CheckPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $post
     * @return mixed
     */
    public function handle($request, Closure $next, $post)
    {
        if(Auth::guest())
        {
            return redirect('login');
        }
        if (($request->session()->get("post") != $post)) {
            switch($request->session()->get("post"))
            {
                case 'Медсестра': return redirect('nurse'); break;
                case 'Врач': return redirect('doctor'); break;
                case 'Заведующий отделением': return redirect('head_physician'); break;
                default: redirect('login');
            }
        }

        return $next($request);
    }
}


