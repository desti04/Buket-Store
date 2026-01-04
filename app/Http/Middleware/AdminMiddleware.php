<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Route admin kamu sudah pakai auth, jadi pasti ada user
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
