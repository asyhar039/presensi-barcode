<!DOCTYPE html>
<html>
<head>
    <title>QR Presensi</title>
</head>
<body>
    <h2>QR Presensi Siswa</h2>
    <form method="POST" action="{{ url('/logout') }}" style="float:right;">
        @csrf
        <button type="submit">Logout</button>
    </form>

    @if($session)
        <p>Session Code: {{ $session->session_code }}</p>

        {!! $qrCode !!}
    @else
        <p>Belum ada sesi presensi.</p>
    @endif
</body>
</html>
