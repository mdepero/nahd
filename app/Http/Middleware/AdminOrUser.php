<?php

namespace App\Http\Middleware;

use Closure;

class AdminOrUser
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
        if(!session('admin') && !session('key')){
            return redirect('/login')->withErrors(['You do not have permission to view that page.']);
        }
        return $next($request);
    }
}
