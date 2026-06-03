<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard SIPAS</h2>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout-btn" type="submit">
            Logout
        </button>
    </form>

    <h2>
        Selamat Datang,
        {{ Auth::user()->nm_pasien }}
    </h2>
</body>
</html>