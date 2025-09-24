<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response('<h1>403 Forbidden</h1><p>You will be redirected in 3 seconds...</p>', 403)
                ->header('Refresh', '3;url=' . url('/'));
        }
        return $next($request);
    }
}
