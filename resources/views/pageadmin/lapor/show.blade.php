@extends('template-admin.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Laporan /</span> {{ $lapor->nama_lengkap }}</h4>

        <!-- Identitas Card -->
        <div class="card mb-4">
            <h5 class="card-header text-primary">Identitas</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Nama Lengkap:</strong> {{ $lapor->nama_lengkap }}
                        </div>
                        <div class="mb-3">
                            <strong>Nomor Identitas:</strong> {{ $lapor->nomor_identitas }}
                        </div>
                        <div class="mb-3">
                            <strong>Alamat:</strong> {{ $lapor->alamat }}
                        </div>
                        <div class="mb-3">
                            <strong>No. HP:</strong> {{ $lapor->no_hp }}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> {{ $lapor->email }}
                        </div>
                        <div class="mb-3">
                            <strong>Unit Kerja / Fakultas / Instansi:</strong> {{ $lapor->nama_unit_kerja_fakultas_instansi }}
                        </div>
                        <div class="mb-3">
                            <strong>File Identitas:</strong> 
                            @if ($lapor->file_identitas)
                                <a href="{{ asset('identitas/' . $lapor->file_identitas) }}" target="_blank">Lihat File</a>
                            @else
                                Tidak ada file identitas
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Status Pelapor:</strong> {{ $lapor->status_pelapor }}
                        </div>
                        <div class="mb-3">
                            <strong>Kategori:</strong> {{ $lapor->kategori }}
                        </div>
                        <div class="mb-3">
                            <strong>Nama Lengkap Terlapor:</strong> {{ $lapor->nama_lengkap_terlapor }}
                        </div>
                        <div class="mb-3">
                            <strong>Status Terlapor:</strong> {{ $lapor->status_terlapor }}
                        </div>
                        <div class="mb-3">
                            <strong>No. HP Terlapor:</strong> {{ $lapor->no_hp_terlapor }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peristiwa Card -->
        <div class="card mb-4">
            <h5 class="card-header text-primary">Peristiwa</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Peristiwa:</strong> {{ $lapor->peristiwa }}
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Peristiwa:</strong> {{ $lapor->tanggal_peristiwa }}
                        </div>
                        <div class="mb-3">
                            <strong>Lokasi Peristiwa:</strong> {{ $lapor->lokasi_peristiwa }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Kronologi Peristiwa:</strong> {!! nl2br(e($lapor->kronologi_peristiwa)) !!}
                        </div>
                        <div class="mb-3">
                            <strong>File Bukti Tindakan:</strong> 
                            @if ($lapor->file_bukti_tindakan)
                                <a href="{{ asset('buktitindakan/' . $lapor->file_bukti_tindakan) }}" target="_blank">Lihat File</a>
                            @else
                                Tidak ada file bukti tindakan
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('lapor.index') }}" class="btn btn-danger">Kembali</a>
    </div>
@endsection
