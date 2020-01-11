<?php

namespace App\Http\Middleware;

use Closure;

class VerfiyIsAdmin
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
      if (!auth()->user()->isAdmin()) {
        return redirect('home');
      }
      return $next($request);
    }
}
