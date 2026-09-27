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

        // Cek apakah role user ada dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            // Redirect ke dashboard sesuai role mereka
            return match ($userRole) {
                'admin'  => redirect('/admin/dashboard')->with('error', 'Akses ditolak. Halaman ini bukan untuk role kamu.'),
                'bk'     => redirect('/bk/dashboard')->with('error', 'Akses ditolak. Halaman ini bukan untuk role kamu.'),
                default  => redirect('/siswa/dashboard')->with('error', 'Akses ditolak. Halaman ini bukan untuk role kamu.'),
            };
        }

        return $next($request);
    }
}
