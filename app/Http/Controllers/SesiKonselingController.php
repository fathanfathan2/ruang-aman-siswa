<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesiKonseling;
use App\Models\PesanKonseling;

class SesiKonselingController extends Controller
{
    // ==========================================
    // RESOURCE ROUTES (sesi-konseling.*)
    // Dipakai oleh Davin untuk kelola jadwal
    // ==========================================

    /**
     * Daftar semua sesi konseling
     */
    public function index()
    {
        $sesiKonselings = SesiKonseling::with('siswa')->latest()->get();
        return view('sesi_konseling.index', compact('sesiKonselings'));
    }

    /**
     * Form buat jadwal konseling baru
     */
    public function create()
    {
        return view('sesi_konseling.create');
    }

    /**
     * Simpan jadwal konseling baru (dari resource route)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'topik'  => 'required|string|max:255',
            'jadwal' => 'required|date|after:now',
            'tipe'   => 'required|in:terbuka,anonim',
        ]);

        $validated['siswa_id'] = auth()->id();
        $validated['status']   = 'menunggu';

        SesiKonseling::create($validated);

        return redirect()->route('sesi-konseling.index')
            ->with('success', 'Booking konseling berhasil diajukan!');
    }

    /**
     * Halaman detail sesi konseling + ruang tanya jawab (chat)
     */
    public function show($id)
    {
        $sesiKonseling = SesiKonseling::with(['siswa', 'pesans.pengirim'])->findOrFail($id);
        return view('sesi_konseling.show', compact('sesiKonseling'));
    }

    /**
     * Hapus sesi konseling
     */
    public function destroy($id)
    {
        SesiKonseling::findOrFail($id)->delete();

        return redirect()->route('sesi-konseling.index')
            ->with('success', 'Jadwal konseling berhasil dihapus.');
    }

    // ==========================================
    // FITUR SISWA (Fathan's routes: siswa.konseling.*)
    // ==========================================

    public function dashboardSiswa()
    {
        $userId           = auth()->id();
        $laporans         = \App\Models\Laporan::where('user_id', $userId)->latest()->get();
        $sesiKonselings   = \App\Models\SesiKonseling::with(['pesans'])->where('siswa_id', $userId)->latest()->get();
        $jumlahKonseling  = $sesiKonselings->count();

        return view('siswa.dashboard', compact('laporans', 'sesiKonselings', 'jumlahKonseling'));
    }

    public function createKonseling()
    {
        return view('siswa.konseling');
    }

    /**
     * Simpan booking konseling dari form siswa (redirect ke dashboard siswa)
     */
    public function storeKonseling(Request $request)
    {
        $validated = $request->validate([
            'topik'  => 'required|string|max:255',
            'jadwal' => 'required|date|after:now',
            'tipe'   => 'required|in:terbuka,anonim',
        ]);

        $validated['siswa_id'] = auth()->id();
        $validated['status']   = 'menunggu';

        SesiKonseling::create($validated);

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Booking konseling berhasil diajukan! Tunggu konfirmasi dari Guru BK.');
    }

    // ==========================================
    // FITUR GURU BK
    // ==========================================

    /**
     * Daftar semua pengajuan konseling (untuk halaman BK)
     */
    public function indexBk()
    {
        $sesiKonselings = SesiKonseling::with(['siswa', 'pesans'])->latest()->get();
        return view('bk.konseling', compact('sesiKonselings'));
    }

    /**
     * Update status konseling (setujui / tolak / selesai)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak,selesai',
        ]);

        SesiKonseling::findOrFail($id)->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', 'Status konseling berhasil diperbarui.');
    }

    // ==========================================
    // FITUR TANYA JAWAB / CHAT (REALTIME DUA ARAH)
    // ==========================================

    /**
     * Kirim pesan baru dalam sesi konseling (mendukung submit form biasa & AJAX realtime)
     */
    public function storePesan(Request $request, $id)
    {
        $validated = $request->validate([
            'isi' => 'required|string|max:2000',
        ]);

        $sesi = SesiKonseling::findOrFail($id);

        // Jangan izinkan kirim jika sesi sudah selesai atau ditolak
        if (in_array($sesi->status, ['ditolak', 'selesai'])) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi konseling telah selesai atau ditolak. Obrolan dinonaktifkan.'
                ], 422);
            }
            return redirect()->back()->with('error', 'Sesi konseling telah selesai atau ditolak.');
        }

        $pesan = PesanKonseling::create([
            'sesi_konseling_id' => $id,
            'pengirim_id'       => auth()->id(),
            'isi'               => trim($validated['isi']),
        ]);

        $pesan->load('pengirim');

        // Jika request via AJAX / Fetch
        if ($request->expectsJson() || $request->ajax()) {
            $currentUser = auth()->user();
            return response()->json([
                'success' => true,
                'pesan'   => [
                    'id'            => $pesan->id,
                    'isi'           => $pesan->isi,
                    'pengirim_id'   => $pesan->pengirim_id,
                    'pengirim_name' => $currentUser->name,
                    'pengirim_role' => $currentUser->role ?? 'siswa',
                    'avatar_letter' => strtoupper(substr($currentUser->name, 0, 1)),
                    'created_at'    => $pesan->created_at->format('H:i'),
                    'time_ago'      => $pesan->created_at->diffForHumans(),
                    'is_mine'       => true,
                    'is_bk'         => in_array($currentUser->role ?? '', ['bk', 'admin']),
                ]
            ]);
        }

        return redirect()->back()->with('pesan_success', 'Pesan terkirim!');
    }

    /**
     * Ambil pesan-pesan terbaru untuk polling realtime otomatis
     */
    public function getPesan(Request $request, $id)
    {
        $sesi = SesiKonseling::findOrFail($id);
        $afterId = (int) $request->query('after_id', 0);

        $pesans = PesanKonseling::with('pengirim')
            ->where('sesi_konseling_id', $id)
            ->when($afterId > 0, function ($query) use ($afterId) {
                return $query->where('id', '>', $afterId);
            })
            ->oldest()
            ->get();

        $currentUser = auth()->user();
        $isBkOrAdmin = in_array($currentUser->role ?? '', ['bk', 'admin']);
        $isAnonim    = $sesi->tipe === 'anonim';

        $data = $pesans->map(function ($p) use ($currentUser, $isBkOrAdmin, $isAnonim, $sesi) {
            $isMine  = $p->pengirim_id === $currentUser->id;
            $isSiswa = $p->pengirim_id === $sesi->siswa_id;
            $senderRole = $p->pengirim->role ?? 'siswa';

            if ($isMine) {
                $senderName = 'Kamu';
                $avatarLetter = substr($currentUser->name, 0, 1);
            } elseif ($isAnonim && $isBkOrAdmin && $isSiswa) {
                $senderName   = '🔒 Anonim';
                $avatarLetter = '?';
            } else {
                $senderName   = $p->pengirim->name ?? 'Pengguna';
                $avatarLetter = substr($p->pengirim->name ?? '?', 0, 1);
            }

            return [
                'id'            => $p->id,
                'isi'           => $p->isi,
                'pengirim_id'   => $p->pengirim_id,
                'pengirim_name' => $senderName,
                'pengirim_role' => $senderRole,
                'avatar_letter' => strtoupper($avatarLetter),
                'created_at'    => $p->created_at->format('H:i'),
                'time_ago'      => $p->created_at->diffForHumans(),
                'is_mine'       => $isMine,
                'is_bk'         => in_array($senderRole, ['bk', 'admin']),
                'is_anonim'     => $isAnonim && $isBkOrAdmin && $isSiswa,
            ];
        });

        return response()->json([
            'success'     => true,
            'status'      => $sesi->status,
            'total_pesan' => $sesi->pesans()->count(),
            'pesans'      => $data,
        ]);
    }

    /**
     * Hapus semua obrolan/pesan dalam sesi konseling (Hanya Guru BK / Admin)
     */
    public function clearPesan(Request $request, $id)
    {
        $sesi = SesiKonseling::findOrFail($id);
        $user = auth()->user();

        // Validasi hak akses: Guru BK atau Admin
        if (!in_array($user->role ?? '', ['bk', 'admin'])) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya Guru BK atau Admin yang dapat menghapus seluruh obrolan.'
                ], 403);
            }
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        // Hapus semua pesan dalam sesi ini
        PesanKonseling::where('sesi_konseling_id', $id)->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Semua riwayat obrolan berhasil dibersihkan.'
            ]);
        }

        return redirect()->back()->with('success', 'Semua pesan obrolan berhasil dihapus.');
    }

    /**
     * Hapus satu pesan tertentu (Guru BK / Admin atau pengirim pesan)
     */
    public function destroyPesan(Request $request, $id, $pesanId)
    {
        $sesi = SesiKonseling::findOrFail($id);
        $pesan = PesanKonseling::where('sesi_konseling_id', $id)->findOrFail($pesanId);
        $user = auth()->user();

        $isStaff = in_array($user->role ?? '', ['bk', 'admin']);
        $isOwner = $pesan->pengirim_id === $user->id;

        if (!$isStaff && !$isOwner) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki izin menghapus pesan ini.'
                ], 403);
            }
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $pesan->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dihapus.'
            ]);
        }

        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }
}