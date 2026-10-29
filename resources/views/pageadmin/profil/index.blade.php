@extends('template-admin.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Profil</h4>
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <form method="POST" action="{{ route('profil.username') }}" class="card mb-4">
        @csrf
        @method('PUT')
        <h5 class="card-header">Username</h5>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username', auth()->user()->username) }}" autocomplete="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password_saat_ini">Password saat ini</label>
                <input type="password" id="password_saat_ini" name="password_saat_ini" class="form-control" autocomplete="current-password" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan username</button>
        </div>
    </form>

    <form method="POST" action="{{ route('profil.password') }}" class="card mb-4">
        @csrf
        @method('PUT')
        <h5 class="card-header">Password</h5>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label" for="current_password">Password saat ini</label>
                <input type="password" id="current_password" name="current_password" class="form-control" autocomplete="current-password" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password baru</label>
                <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" minlength="8" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Konfirmasi password baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan password</button>
        </div>
    </form>

    <form method="POST" action="{{ route('profil.pin') }}" class="card mb-4" id="pin">
        @csrf
        @method('PUT')
        <h5 class="card-header">PIN</h5>
        <div class="card-body">
            <p class="text-muted">PIN dipakai setiap kali membuka daftar laporan.</p>
            <div class="mb-3">
                <label class="form-label" for="current_pin">PIN saat ini</label>
                <input type="password" id="current_pin" name="current_pin" class="form-control" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="new_pin">PIN baru</label>
                <input type="password" id="new_pin" name="new_pin" class="form-control" autocomplete="off" minlength="4" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="new_pin_confirmation">Konfirmasi PIN baru</label>
                <input type="password" id="new_pin_confirmation" name="new_pin_confirmation" class="form-control" autocomplete="off" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan PIN</button>
        </div>
    </form>
</div>
@endsection
