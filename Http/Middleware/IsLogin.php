<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        // dd($request);
      // logger('Loggedin middleware called.');
      if(session()->has('user_id'))
      {
          return $next($request);
      }
      else{
          return redirect('no-access');
      }
    }
}
