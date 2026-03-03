<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
<h2>Admin Login</h2>

@if($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ url('/admin/login') }}">
    @csrf
    <label>Username:</label><br>
    <input type="text" name="username" value="{{ old('username') }}" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Masuk</button>
</form>
</body>
</html>
