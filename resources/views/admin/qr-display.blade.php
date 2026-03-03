<!DOCTYPE html>
<html>
<head>
    <title>QR Presensi Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        .info-box {
            background-color: #e7f3ff;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
        }
        .info-box p {
            margin: 8px 0;
            font-size: 16px;
        }
        .info-label {
            font-weight: bold;
            color: #007bff;
        }
        .qr-code {
            margin: 30px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .buttons {
            margin-top: 20px;
        }
        button, a {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-print {
            background-color: #28a745;
            color: white;
        }
        .btn-print:hover {
            background-color: #218838;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .session-code {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin: 15px 0;
        }
        @media print {
            .buttons {
                display: none;
            }
            body {
                background-color: white;
            }
            .container {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>QR Code Presensi Siswa</h1>

    <div class="info-box">
        <p><span class="info-label">Tanggal:</span> {{ $qrData['date'] }} ({{ $qrData['day'] }})</p>
        <p><span class="info-label">Waktu Mulai:</span> {{ $qrData['start_time'] }}</p>
        <p><span class="info-label">Waktu Berakhir:</span> {{ $qrData['end_time'] }}</p>
        <p><span class="info-label">Batas Waktu Presensi:</span> {{ $qrData['time_limit'] }} menit</p>
    </div>

    <div class="session-code">
        Kode Sesi: {{ $qrData['session_code'] }}
    </div>

    <div class="qr-code">
        {!! app('SimpleSoftwareIO\QrCode\Generator')->size(300)->generate($qrContent ?? '') !!}
    </div>

    <div class="buttons">
        <button class="btn-print" onclick="window.print()">Cetak QR Code</button>
        <a class="btn-back" href="{{ url('/admin/dashboard') }}">Kembali ke Dashboard</a>
    </div>
</div>

</body>
</html>
