<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
<h2>Dashboard Admin</h2>
<form method="POST" action="{{ url('/admin/logout') }}" style="float:right;">
    @csrf
    <button type="submit">Logout</button>
</form>

@if(session('status'))
    <div style="color:green;">{{ session('status') }}</div>
@endif

<h3>Unggah Data Siswa</h3>
<form method="POST" action="{{ url('/admin/upload-students') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".csv" required>
    <button type="submit">Upload</button>
</form>

<h3>Generate QR Code Presensi</h3>
<p>Buat QR code baru untuk sesi presensi siswa hari ini.</p>
<a href="{{ url('/admin/qr-generator') }}" style="display:inline-block; padding:10px 20px; background-color:#28a745; color:white; text-decoration:none; border-radius:4px;">
    Buat QR Code Presensi
</a>

<h3>Daftar Siswa</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <tr><th>NIS</th><th>Nama</th><th>Kelas</th><th>Tanggal Lahir</th></tr>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->nis }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->class }}</td>
            <td>{{ $student->birth_date?->format('Y-m-d') }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>
