<?php

namespace App\Http\Middleware;

use Closure;

class Role
{

    public function handle($request, Closure $next, $routeRoles)
    {
        if (!auth()->check()) {
            return redirect()->guest('login');
        }
        $nameArray = explode('|', $routeRoles);
        $auth = auth()->user();

        $roleName = $auth->role;
        if (!in_array($roleName, $nameArray)) {
            abort(401, 'NO PERMISSION');
        }

        return $next($request);
    }
}
