<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Menu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $menu_type)
    {
        $request->session()->put('menu_type', $menu_type);
        return $next($request);
    }
}
