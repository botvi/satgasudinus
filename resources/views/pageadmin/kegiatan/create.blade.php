@extends('template-admin.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kegiatan /</span> Create</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Kegiatan</h5>
                    </div>
                    <div class="card-body">
                        <form id="kegiatanForm" method="POST" action="{{ route('kegiatans.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title :</label>
                                <input type="text" id="title" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" maxlength="576" required></textarea>
                                <div id="deskripsiHelp" class="form-text">Maksimal 576 karakter.</div>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar:</label>
                                <input type="file" id="gambar" name="gambar" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary text-end">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    /* Input Deskripsi */
        document.getElementById('deskripsi').addEventListener('input', function () {
            var maxLength = this.getAttribute('maxlength');
            var currentLength = this.value.length;
            
            if (currentLength >= maxLength) {
                document.getElementById('deskripsiHelp').innerText = 'Anda telah mencapai batas maksimal karakter.';
            } else {
                document.getElementById('deskripsiHelp').innerText = 'Maksimal ' + maxLength + ' karakter. ' + (maxLength - currentLength) + ' karakter tersisa.';
            }
        });
    
    </script>
@endsection