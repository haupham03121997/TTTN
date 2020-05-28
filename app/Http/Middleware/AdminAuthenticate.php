<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminAuthenticate
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next,$guard='admin')
    {
        if (!Auth::guard('admin')->check()) {
            // return '123';
           
            return redirect('/admin');
        }
       
          return $next($request);
    }
   
  
}
