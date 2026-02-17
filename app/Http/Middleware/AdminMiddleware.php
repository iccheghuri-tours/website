<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if (!$request->user() || $request->user()->role !== 'admin') {
        abort(403);
            } else if ( !$request->user()->hasVerifiedEmail()){
                abort(403, 'Email not verified.');
            }
            else if ($request->user()->two_factor_secret === null) {
                abort(403, 'Two-factor authentication not enabled.');
            }   

        return $next($request);
    }
}
