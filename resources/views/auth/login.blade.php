@extends('layouts.auth')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="card shadow p-4" style="width:400px">

        <h4 class="text-center fw-bold mb-3">Login SISPEKA</h4>

            @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-3">
                <label>Login Sebagai</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="wali">Wali</option>
                </select>
            </div>

            <div class="mb-3">
                <label id="login-label">Email / NIP / NIS</label>
                <input type="text"
                       name="login"
                       id="login-input"
                       class="form-control"
                       placeholder="Masukkan Email / NIP / NIS"
                       required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-primary w-100 mb-2">Login</button>

            <div class="text-center">
                <a href="{{ route('register') }}">Buat akun baru</a>
            </div>
        </form>

    </div>
</div>

<script>
document.getElementById('role').addEventListener('change', function () {
    const label = document.getElementById('login-label');
    const input = document.getElementById('login-input');

    if (this.value === 'admin') {
        label.textContent = 'Email';
        input.placeholder = 'Masukkan Email';
        input.type = 'email';
    } else if (this.value === 'guru') {
        label.textContent = 'NIP';
        input.placeholder = 'Masukkan NIP';
        input.type = 'text';
    } else if (this.value === 'wali') {
        label.textContent = 'NIS';
        input.placeholder = 'Masukkan NIS';
        input.type = 'text';
    } else {
        label.textContent = 'Email / NIP / NIS';
        input.placeholder = 'Masukkan Email / NIP / NIS';
        input.type = 'text';
    }
});
</script>
@endsection
