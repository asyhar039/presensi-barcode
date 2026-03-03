<!DOCTYPE html>
<html>
<head>
    <title>Login Siswa</title>
</head>
<body>
    <h2>Login Siswa</h2>

    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <label>NIS:</label><br>
        <input type="text" name="nis" value="{{ old('nis') }}" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Masuk</button>
    </form>
</body>
</html>
