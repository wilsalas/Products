<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckAuth
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
        if (!Session::has('id_user')) {
            return redirect('/');
          }
  
        return $next($request);
    }
}
