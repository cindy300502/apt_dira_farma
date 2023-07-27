<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (in_array(Auth::user()->level, [1,2,3])) {
            return $next($request);
        }
        return abort(403);


    }
}
