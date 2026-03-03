<!DOCTYPE html>
<html>
<head>
    <title>Generate QR Presensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-link {
            margin-top: 15px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Generate QR Code Presensi</h2>

    <form method="POST" action="{{ url('/admin/generate-qr') }}">
        @csrf

        <div class="form-group">
            <label for="time_limit">Waktu Batas Presensi (menit):</label>
            <input type="number" id="time_limit" name="time_limit" value="30" min="5" max="120" required>
            <small>Berapa menit siswa memiliki kesempatan untuk scan? (5-120 menit)</small>
        </div>

        <button type="submit">Generate QR Code</button>
    </form>

    <div class="back-link">
        <a href="{{ url('/admin/dashboard') }}">← Kembali ke Dashboard</a>
    </div>
</div>

</body>
</html>
