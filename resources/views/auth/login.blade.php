<form action="{{ url('/login') }}" method="POST">
    @csrf

    <label>No RM</label>

    <input
        type="text"
        name="no_rkm_medis"
        required
    >

    <button type="submit">
        Masuk
    </button>
</form>