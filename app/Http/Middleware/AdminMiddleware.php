<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kalau belum login atau ROLENYA BUKAN ADMIN -> Tendang!
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Halaman ini khusus Admin woi!');
        }

        return $next($request);
    }
}