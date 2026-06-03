<form action="{{ route('register') }}" method="POST">
    @csrf

    <input
        type="email"
        name="email"
        placeholder="Email"
        required
    >

    <input
        type="password"
        name="password"
        placeholder="Password"
        required
    >

    <input
        type="password"
        name="password_confirmation"
        placeholder="Konfirmasi Password"
        required
    >

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