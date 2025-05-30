<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated and has the correct role
        if (!auth()->check() || auth()->user()->role !== $role) {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
