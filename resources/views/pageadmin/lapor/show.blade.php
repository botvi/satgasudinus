@extends('template-admin.layout')

@section('content')
@php
    $file = function ($dir, $name, $label) {
        if (! $name) return '<div class="file is-empty"><b>' . e($label) . '</b><span>Tidak ada file</span></div>';
        $url = asset($dir . '/' . $name);
        $img = preg_match('/\.(jpe?g|png|webp)$/i', $name) ? '<img src="' . e($url) . '" alt="' . e($label) . '">' : '';
        return '<a class="file" href="' . e($url) . '" target="_blank" rel="noopener">' . $img . '<b>' . e($label) . '</b><span>Buka file</span></a>';
    };
@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <a class="crumb" href="{{ route('lapor.index') }}">← Semua laporan</a>
    <div class="pg-head">
        <div>
            <h1>Laporan #{{ $lapor->id }} · {{ $lapor->nama_lengkap }}</h1>
            <p>
                <span class="pill">{{ $lapor->status_pelapor }}</span>
                <span class="pill {{ $lapor->kategori === 'Korban' ? 'pill--alert' : '' }}">{{ $lapor->kategori }}</span>
                <span class="ms-1">Dilaporkan {{ $lapor->created_at?->locale('id')->translatedFormat('j F Y, H:i') }}</span>
            </p>
        </div>
        <div class="act">
            <a href="{{ route('lapor.download', $lapor->id) }}" class="btn btn-primary">Unduh PDF</a>
            <form action="{{ route('lapor.destroy', $lapor->id) }}" method="POST" class="d-inline delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>

    <div class="det">
        <div>
            <div class="card mb-4"><div class="card-body">
                <h2 class="ct">Peristiwa</h2>
                <dl class="dl">
                    <div><dt>Jenis peristiwa</dt><dd>{{ $lapor->peristiwa }}</dd></div>
                    <div><dt>Tanggal</dt><dd>{{ \Illuminate\Support\Carbon::parse($lapor->tanggal_peristiwa)->locale('id')->translatedFormat('j F Y') }}</dd></div>
                    <div><dt>Lokasi</dt><dd>{{ $lapor->lokasi_peristiwa }}</dd></div>
                    <div><dt>Kronologi</dt><dd class="kron">{{ $lapor->kronologi_peristiwa }}</dd></div>
                </dl>
            </div></div>

            <div class="row g-4">
                <div class="col-md-6"><div class="card h-100"><div class="card-body">
                    <h2 class="ct">Pelapor</h2>
                    <dl class="dl">
                        <div><dt>Nama</dt><dd>{{ $lapor->nama_lengkap }}</dd></div>
                        <div><dt>Nomor identitas</dt><dd>{{ $lapor->nomor_identitas }}</dd></div>
                        <div><dt>Alamat</dt><dd>{{ $lapor->alamat }}</dd></div>
                        <div><dt>No. HP</dt><dd>{{ $lapor->no_hp }}</dd></div>
                        <div><dt>Email</dt><dd>{{ $lapor->email }}</dd></div>
                        <div><dt>Unit / instansi</dt><dd>{{ $lapor->nama_unit_kerja_fakultas_instansi }}</dd></div>
                    </dl>
                </div></div></div>
                <div class="col-md-6"><div class="card h-100"><div class="card-body">
                    <h2 class="ct">Terlapor</h2>
                    <dl class="dl">
                        <div><dt>Nama</dt><dd>{{ $lapor->nama_lengkap_terlapor }}</dd></div>
                        <div><dt>Status</dt><dd>{{ $lapor->status_terlapor }}</dd></div>
                        <div><dt>No. HP</dt><dd>{{ $lapor->no_hp_terlapor }}</dd></div>
                    </dl>
                </div></div></div>
            </div>
        </div>

        <aside class="card"><div class="card-body">
            <h2 class="ct">Berkas</h2>
            {!! $file('identitas', $lapor->file_identitas, 'File identitas') !!}
            {!! $file('buktitindakan', $lapor->file_bukti_tindakan, 'Bukti tindakan / lokasi') !!}
        </div></aside>
    </div>
</div>
@endsection
