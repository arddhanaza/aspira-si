<?php

namespace App\Http\Middleware;

use Closure;

class IsBPMMiddleware
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
        if(session(0)->getTable() == 'bpm'){
            return $next($request);
        }
        return redirect('/');
    }
}
