@extends('template-admin.layout')

@section('content')
@php
    $statuses = ['Mahasiswa', 'Dosen', 'Tenaga Kependidikan', 'Masyarakat Umum'];
    $total = max(1, $totalLapor ?? 0);
@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="pg-head">
        <div>
            <h1>Laporan</h1>
            <p>Laporan masuk dari formulir pelaporan situs publik.</p>
        </div>
    </div>

    <div class="stats">
        <div class="card stat">
            <h2>Semua laporan</h2>
            <div class="stat__total">{{ $totalLapor ?? 0 }}<small>laporan masuk</small></div>
        </div>
        @foreach ([['Berdasarkan pelapor', $countStatusPelapor], ['Berdasarkan terlapor', $countStatusTerlapor]] as [$judul, $data])
        <div class="card stat">
            <h2>{{ $judul }}</h2>
            <ul>
                @foreach ($statuses as $st)
                @php $n = $data[$st] ?? 0; @endphp
                <li><span>{{ $st }}</span><b>{{ $n }}</b><span class="bar"><i style="width:{{ round($n / $total * 100) }}%"></i></span></li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>

    <div class="card">
        <h5 class="card-header">Daftar laporan</h5>
        <div class="table-responsive p-4">
            <table id="example" class="display compact nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelapor</th>
                        <th>Status</th>
                        <th>Kategori</th>
                        <th>Tanggal peristiwa</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lapors as $lapor)
                    <tr>
                        <td>#{{ $lapor->id }}</td>
                        <td><strong>{{ $lapor->nama_lengkap }}</strong><br><small class="text-muted">{{ $lapor->nama_unit_kerja_fakultas_instansi }}</small></td>
                        <td><span class="pill">{{ $lapor->status_pelapor }}</span></td>
                        <td><span class="pill {{ $lapor->kategori === 'Korban' ? 'pill--alert' : '' }}">{{ $lapor->kategori }}</span></td>
                        <td data-order="{{ $lapor->tanggal_peristiwa }}">{{ \Illuminate\Support\Carbon::parse($lapor->tanggal_peristiwa)->locale('id')->translatedFormat('j M Y') }}</td>
                        <td>{{ $lapor->no_hp }}<br><small class="text-muted">{{ $lapor->email }}</small></td>
                        <td>
                            <div class="act">
                                <a href="{{ route('lapor.show', $lapor->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                <a href="{{ route('lapor.download', $lapor->id) }}" class="btn btn-sm btn-info">PDF</a>
                                <form action="{{ route('lapor.destroy', $lapor->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
