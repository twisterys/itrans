<?php

namespace App\Http\Middleware;

use Closure;

class Clown
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
        if(!session()->has('expiration'))
           return redirect()->route('expiration');
        $expire = intval(session()->get('expiration')) ;
        if(intval(now()->timestamp) >=  $expire)
            return redirect()->route('expiration');

        return $next($request);
    }
}
