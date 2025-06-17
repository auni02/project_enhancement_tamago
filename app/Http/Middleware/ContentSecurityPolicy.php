<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
{
    logger('✅ CSP Middleware triggered');

    $response = $next($request);

    $response->headers->set('Content-Security-Policy',
        "default-src 'self'; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'"
    );

    return $response;
}

}

