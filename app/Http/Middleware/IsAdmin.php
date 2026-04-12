<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek: Apakah dia Login? DAN Apakah kolom is_admin dia true?
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Silakan masuk
        }

        // Kalau bukan admin, tendang ke home
        return redirect('/')->with('error', 'Akses ditolak! Anda bukan Admin.');
    }
}