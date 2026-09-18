<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Konseling - Ruang Aman Siswa</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 30px; max-width: 600px; margin: auto;">
    
    <h2 style="color: #2563eb;">Form Pengajuan Konseling BK</h2>
    <p>Silakan isi form di bawah ini untuk mengatur jadwal cerita atau bimbingan dengan Guru BK. Jangan khawatir, privasimu aman.</p>

    <!-- Form ini akan mengirim data ke SesiKonselingController -->
    <form action="/siswa/konseling" method="POST" style="background: #f3f4f6; padding: 20px; border-radius: 8px;">
        <!-- @csrf wajib ada di Laravel agar form aman dari serangan hacker -->
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Topik Konseling:</label><br>
            <input type="text" name="topik" placeholder="Misal: Masalah Akademik / Bullying / Karir" required style="width: 95%; padding: 8px; margin-top: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Rencana Jadwal:</label><br>
            <input type="datetime-local" name="jadwal" required style="width: 95%; padding: 8px; margin-top: 5px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold;">Tipe Konseling:</label><br>
            <select name="tipe" style="width: 100%; padding: 8px; margin-top: 5px;">
                <option value="terbuka">Terbuka (Identitas Diketahui Guru BK)</option>
                <option value="anonim">Anonim (Rahasiakan Namaku)</option>
            </select>
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #2563eb; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            Ajukan Jadwal
        </button>
    </form>

</body>
</html>