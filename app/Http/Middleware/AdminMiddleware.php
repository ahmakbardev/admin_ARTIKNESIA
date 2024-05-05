<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna telah login
        if (Auth::check()) {
            // Memeriksa apakah pengguna memiliki role_id 1 (admin)
            if (Auth::user()->role_id === 1) {
                return $next($request);
            }
        }

        // Jika tidak memiliki role yang sesuai, arahkan kembali ke halaman login
        return redirect('/login');
    }
}
