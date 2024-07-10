@extends('template-admin.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Tambah Laporan</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_identitas" class="form-label">Nomor Identitas</label>
                        <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" required>
                    </div>

                    <div class="mb-3">
                        <label for="file_identitas" class="form-label">File Identitas (PDF, JPG, PNG)</label>
                        <input type="file" class="form-control" id="file_identitas" name="file_identitas" accept=".pdf,.jpg,.png" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="nama_unit_kerja_fakultas_instansi" class="form-label">Nama Unit Kerja/Fakultas/Instansi</label>
                        <input type="text" class="form-control" id="nama_unit_kerja_fakultas_instansi" name="nama_unit_kerja_fakultas_instansi">
                    </div>

                    <div class="mb-3">
                        <label for="status_pelapor" class="form-label">Status Pelapor</label>
                        <input type="text" class="form-control" id="status_pelapor" name="status_pelapor">
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori">
                    </div>

                    <div class="mb-3">
                        <label for="nama_lengkap_terlapor" class="form-label">Nama Lengkap Terlapor</label>
                        <input type="text" class="form-control" id="nama_lengkap_terlapor" name="nama_lengkap_terlapor">
                    </div>

                    <div class="mb-3">
                        <label for="status_terlapor" class="form-label">Status Terlapor</label>
                        <input type="text" class="form-control" id="status_terlapor" name="status_terlapor">
                    </div>

                    <div class="mb-3">
                        <label for="no_hp_terlapor" class="form-label">No. HP Terlapor</label>
                        <input type="text" class="form-control" id="no_hp_terlapor" name="no_hp_terlapor">
                    </div>

                    <div class="mb-3">
                        <label for="peristiwa" class="form-label">Peristiwa</label>
                        <textarea class="form-control" id="peristiwa" name="peristiwa" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_peristiwa" class="form-label">Tanggal Peristiwa</label>
                        <input type="date" class="form-control" id="tanggal_peristiwa" name="tanggal_peristiwa">
                    </div>

                    <div class="mb-3">
                        <label for="lokasi_peristiwa" class="form-label">Lokasi Peristiwa</label>
                        <input type="text" class="form-control" id="lokasi_peristiwa" name="lokasi_peristiwa">
                    </div>

                    <div class="mb-3">
                        <label for="kronologi_peristiwa" class="form-label">Kronologi Peristiwa</label>
                        <textarea class="form-control" id="kronologi_peristiwa" name="kronologi_peristiwa" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="file_bukti_tindakan" class="form-label">File Bukti Tindakan (PDF, JPG, PNG)</label>
                        <input type="file" class="form-control" id="file_bukti_tindakan" name="file_bukti_tindakan" accept=".pdf,.jpg,.png" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
