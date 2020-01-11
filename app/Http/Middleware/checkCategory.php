<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class checkCategory
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
      $count = Category::all()->count();
      if ($count == 0) {
        session()->flash('error', 'First you nedd to add some categories.');
        return redirect(route('categories.index'));
      }
        return $next($request);
    }
}
