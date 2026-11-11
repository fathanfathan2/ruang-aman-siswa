<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Pastikan user yang login memiliki role yang diizinkan.
     *
     * Contoh penggunaan di routes:
     *   ->middleware('role:bk')
     *   ->middleware('role:admin')
     *   ->middleware('role:siswa')
     *   ->middleware('role:admin,bk')  ← bisa multi-role
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Jika belum login, redirect ke halaman login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        // Sistem pembatasan role dinonaktifkan sesuai permintaan:
        // Semua user yang sudah login bebas mengakses halaman siswa, BK, dan admin.
        return $next($request);
    }
}
