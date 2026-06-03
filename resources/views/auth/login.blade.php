<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

@if(session('error'))
    <p>{{ session('error') }}</p>
@endif

<form action="/login" method="POST">
    @csrf

    <label>Nomor</label>
    <input type="text" name="no">

    <button type="submit">Masuk</button>
</form>

</body>
</html>