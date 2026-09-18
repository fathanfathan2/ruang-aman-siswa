<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru BK - Ruang Aman Siswa</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 30px; max-width: 800px; margin: auto;">
    
    <h2 style="color: #2563eb;">Daftar Pengajuan Konseling Siswa</h2>
    <p>Berikut adalah daftar siswa yang mengajukan jadwal konseling atau curhat.</p>

    <table border="1" style="width: 100%; border-collapse: collapse; text-align: left; margin-top: 20px;">
        <thead style="background-color: #f3f4f6;">
            <tr>
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">Topik</th>
                <th style="padding: 10px;">Tipe</th>
                <th style="padding: 10px;">Jadwal Diajukan</th>
                <th style="padding: 10px;">Status</th>
                <th style="padding: 10px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Nanti data dari database akan di-looping di sini menggunakan foreach -->
            <tr>
                <td style="padding: 10px;">1</td>
                <td style="padding: 10px;">Masalah Akademik</td>
                <td style="padding: 10px;">Terbuka</td>
                <td style="padding: 10px;">2026-09-20 10:00</td>
                <td style="padding: 10px; color: orange; font-weight: bold;">Menunggu</td>
                <td style="padding: 10px;">
                    <form action="/bk/konseling/1/status" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="disetujui">
                        <button type="submit" style="background-color: #22c55e; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;">Setujui</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px;">2</td>
                <td style="padding: 10px;">Bullying</td>
                <td style="padding: 10px; color: red;">Anonim</td>
                <td style="padding: 10px;">2026-09-21 13:00</td>
                <td style="padding: 10px; color: orange; font-weight: bold;">Menunggu</td>
                <td style="padding: 10px;">
                    <form action="/bk/konseling/2/status" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="disetujui">
                        <button type="submit" style="background-color: #22c55e; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;">Setujui</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>