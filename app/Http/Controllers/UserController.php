<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan Halaman Dashboard Admin
     */
    public function dashboard()
    {
        // Menghitung statistik untuk ditampilkan di kotak-kotak dashboard
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalBk = User::where('role', 'bk')->count();
        $totalUser = User::count();

        return view('admin.dashboard', compact('totalSiswa', 'totalBk', 'totalUser'));
    }

    /**
     * Menampilkan Tabel Daftar Semua Pengguna
     */
    public function index()
    {
        // Mengambil semua data pengguna, diurutkan dari yang terbaru
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan Form Tambah Pengguna Baru
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Memproses Penyimpanan Pengguna Baru ke Database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:siswa,bk,admin'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun pengguna berhasil ditambahkan!');
    }

    /**
     * Menampilkan Form Edit Pengguna
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memproses Perubahan Data Pengguna
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Email harus unik, tapi abaikan jika emailnya milik user ini sendiri
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'in:siswa,bk,admin'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Jika form password diisi, berarti admin ingin mereset password user tersebut
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    /**
     * Menghapus Akun Pengguna
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Mencegah admin menghapus akunnya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun pengguna berhasil dihapus!');
    }
}