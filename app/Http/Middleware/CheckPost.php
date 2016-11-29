<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


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
        if ((Auth::user()->health_worker->post != $post)) {
            switch(Auth::user()->health_worker->post)
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


