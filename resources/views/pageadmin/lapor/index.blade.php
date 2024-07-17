@extends('template-admin.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Lapor</h4>

        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Semua</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Semua Laporan</td>
                                    <td>{{ $totalLapor ?? 0 }} Laporan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pelapor</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Mahasiswa</td>
                                    <td>{{ $countStatusPelapor['Mahasiswa'] ?? 0 }} Laporan</td>
                                </tr>
                                <tr>
                                    <td>Dosen</td>
                                    <td>{{ $countStatusPelapor['Dosen'] ?? 0 }} Laporan</td>
                                </tr>
                                <tr>
                                    <td>Tenaga Kependidikan</td>
                                    <td>{{ $countStatusPelapor['Tenaga Kependidikan'] ?? 0 }} Laporan</td>
                                </tr>
                                <tr>
                                    <td>Masyarakat Umum</td>
                                    <td>{{ $countStatusPelapor['Masyarakat Umum'] ?? 0 }} Laporan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Terlapor</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Mahasiswa</td>
                                    <td>{{ $countStatusTerlapor['Mahasiswa'] ?? 0 }} Laporan</td>
                                </tr>
                                <tr>
                                    <td>Dosen</td>
                                    <td>{{ $countStatusTerlapor['Dosen'] ?? 0 }} Laporan</td>
                                </tr>
                                <tr>
                                    <td>Tenaga Kependidikan</td>
                                    <td>{{ $countStatusTerlapor['Tenaga Kependidikan'] ?? 0 }} Laporan</td>
                                </tr>
                                <tr>
                                    <td>Masyarakat Umum</td>
                                    <td>{{ $countStatusTerlapor['Masyarakat Umum'] ?? 0 }} Laporan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Laporan</h5>
            <div class="table-responsive text-nowrap p-4">
                <table id="example" class="display compact nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Identitas</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($lapors as $lapor)
                            <tr>
                                <td>{{ $lapor->id }}</td>
                                <td>{{ $lapor->nama_lengkap }}</td>
                                <td>{{ $lapor->nomor_identitas }}</td>
                                <td>{{ $lapor->alamat }}</td>
                                <td>{{ $lapor->no_hp }}</td>
                                <td>{{ $lapor->email }}</td>
                                <td>
                                    <a href="{{ route('lapor.show', $lapor->id) }}" class="btn btn-sm btn-info">Detail</a>
                                    <form action="{{ route('lapor.destroy', $lapor->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    <a href="{{ route('lapor.download', $lapor->id) }}" class="btn btn-sm btn-success">Unduh PDF</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
