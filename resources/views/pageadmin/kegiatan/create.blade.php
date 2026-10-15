@extends('template-admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css">
<style>#editor{min-height:260px;font-size:1rem;background:#fff}.ql-editor{min-height:260px}</style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kegiatan /</span> Tambah</h4>
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="kegiatanForm" method="POST" action="{{ route('kegiatans.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal kegiatan</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                            </div>
                            <div class="mb-3">
                                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                <input type="text" id="penyelenggara" name="penyelenggara" class="form-control" value="{{ old('penyelenggara') }}" placeholder="Satgas PPK UDINUS">
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" id="kategori" name="kategori" class="form-control" value="{{ old('kategori') }}" placeholder="Seminar, Edukasi, ...">
                            </div>
                            <div class="mb-3">
                                <label for="tempat" class="form-label">Tempat</label>
                                <input type="text" id="tempat" name="tempat" class="form-control" value="{{ old('tempat') }}" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Isi kegiatan</label>
                                <div id="editor">{!! old('deskripsi') !!}</div>
                                <input type="hidden" name="deskripsi" id="deskripsi">
                                <div class="form-text">Gunakan toolbar untuk judul, tebal, daftar, kutipan, dan tautan.</div>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar utama</label>
                                <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" required>
                                <div class="form-text">JPG/PNG/GIF/WebP, maks 5 MB. Otomatis dikompres ke WebP.</div>
                            </div>
                            <div class="mb-3">
                                <label for="video" class="form-label">Video (opsional)</label>
                                <input type="file" id="video" name="video" class="form-control" accept="video/mp4,video/webm,video/quicktime">
                                <div class="form-text">MP4/WebM/MOV, maks 100 MB. Dikonversi ke WebM bila server punya ffmpeg.</div>
                            </div>
                            <div class="mb-3">
                                <label for="media" class="form-label">Dokumentasi tambahan (foto/video)</label>
                                <input type="file" id="media" name="media[]" class="form-control" accept="image/*,video/mp4,video/webm,video/quicktime" multiple>
                                <div class="form-text">Bisa pilih banyak file sekaligus, atau tambah bertahap (maks 20 file). Tampil sebagai galeri geser di halaman kegiatan.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <a href="{{ route('kegiatans.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset('admin/media-picker.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"></script>
<script>
  var quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Tulis isi kegiatan...',
    modules: { toolbar: [[{ header: [2, 3, false] }], ['bold', 'italic', 'underline'], [{ list: 'ordered' }, { list: 'bullet' }], ['blockquote', 'link'], ['clean']] }
  });
  document.getElementById('kegiatanForm').addEventListener('submit', function (e) {
    if (!quill.getText().trim()) { e.preventDefault(); alert('Isi kegiatan wajib diisi.'); return; }
    document.getElementById('deskripsi').value = quill.root.innerHTML;
  });
</script>
@endsection
