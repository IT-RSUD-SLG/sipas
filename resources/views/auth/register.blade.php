<!DOCTYPE html>
<html>
<head>
    <title>Lengkapi Akun</title>
</head>
<body>

<h2>Lengkapi Akun</h2>

<form action="{{ route('register') }}" method="POST">
    @csrf

    <label>Email</label>
    <input type="email" name="email">

    <br><br>

    <label>Password</label>
    <input type="password" name="password">

    <br><br>

    <label>Konfirmasi Password</label>
    <input type="password" name="password_confirmation">

    <br><br>

    
    <button type="submit">
        Simpan
    </button>
    
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif  
</form>

</body>
</html>