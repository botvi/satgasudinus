@extends('template-admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css">
<style>#editor{min-height:260px;font-size:1rem;background:#fff}.ql-editor{min-height:260px}</style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kegiatan /</span> Edit</h4>
        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="kegiatanForm" method="POST" action="{{ route('kegiatans.update', $kegiatan->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $kegiatan->title) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal kegiatan</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', optional($kegiatan->tanggal)->format('Y-m-d')) }}">
                            </div>
                            <div class="mb-3">
                                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                <input type="text" id="penyelenggara" name="penyelenggara" class="form-control" value="{{ old('penyelenggara', $kegiatan->penyelenggara) }}" placeholder="Satgas PPK UDINUS">
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" id="kategori" name="kategori" class="form-control" value="{{ old('kategori', $kegiatan->kategori) }}" placeholder="Seminar, Edukasi, ...">
                            </div>
                            <div class="mb-3">
                                <label for="tempat" class="form-label">Tempat</label>
                                <input type="text" id="tempat" name="tempat" class="form-control" value="{{ old('tempat', $kegiatan->tempat) }}" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Isi kegiatan</label>
                                <div id="editor">{!! old('deskripsi', $kegiatan->isi_html) !!}</div>
                                <input type="hidden" name="deskripsi" id="deskripsi">
                                <div class="form-text">Gunakan toolbar untuk judul, tebal, daftar, kutipan, dan tautan.</div>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar utama</label>
                                <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
                                <div class="form-text">JPG/PNG/GIF/WebP, maks 5 MB. Otomatis dikompres ke WebP.</div>
                                <img src="{{ asset('kegiatan/' . $kegiatan->gambar) }}" alt="Gambar saat ini" class="img-fluid mt-2" width="200">
                            </div>
                            <div class="mb-3">
                                <label for="video" class="form-label">Video (opsional)</label>
                                <input type="file" id="video" name="video" class="form-control" accept="video/mp4,video/webm,video/quicktime">
                                <div class="form-text">MP4/WebM/MOV, maks 100 MB. Dikonversi ke WebM bila server punya ffmpeg.</div>
                                @if ($kegiatan->video)
                                    <video src="{{ asset('kegiatan/' . $kegiatan->video) }}" controls class="mt-2" style="max-width:320px"></video>
                                    <div class="form-check mt-1"><input class="form-check-input" type="checkbox" name="hapus_video" value="1" id="hapus_video"><label class="form-check-label" for="hapus_video">Hapus video</label></div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="media" class="form-label">Dokumentasi tambahan (foto/video)</label>
                                <input type="file" id="media" name="media[]" class="form-control" accept="image/*,video/mp4,video/webm,video/quicktime" multiple>
                                <div class="form-text">Bisa pilih banyak file sekaligus, atau tambah bertahap (maks 20 file). Tampil sebagai galeri geser di halaman kegiatan.</div>
                                @if ($kegiatan->media->isNotEmpty())
                                    <div class="d-flex flex-wrap gap-3 mt-2">
                                        @foreach ($kegiatan->media as $m)
                                            <label class="text-center small">
                                                @if ($m->type === 'video')
                                                    <video src="{{ asset('kegiatan/' . $m->file) }}" width="120" muted></video>
                                                @else
                                                    <img src="{{ asset('kegiatan/' . $m->file) }}" width="120" alt="">
                                                @endif
                                                <span class="d-block"><input type="checkbox" name="hapus_media[]" value="{{ $m->id }}"> Hapus</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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
