@extends('template-admin.layout')

@section('content')
@php use App\Models\Setting; @endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Pengaturan Situs</h4>
    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <h5 class="card-header">Beranda</h5>
            <div class="card-body">
                <div class="mb-3">
                    <label for="video_profil" class="form-label">Video profil</label>
                    <input type="file" id="video_profil" name="video_profil" class="form-control" accept="video/mp4,video/webm,video/quicktime">
                    <div class="form-text">MP4/WebM/MOV, maks 100 MB. Dikonversi ke WebM bila server punya ffmpeg. Kosong = tampil foto.</div>
                    @if (Setting::value('video_profil'))
                        <video src="{{ asset('video/' . Setting::value('video_profil')) }}" controls class="mt-2" style="max-width:320px"></video>
                        <div class="form-check mt-1"><input class="form-check-input" type="checkbox" name="hapus_video" value="1" id="hapus_video"><label class="form-check-label" for="hapus_video">Hapus video</label></div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="sekapur_teks" class="form-label">Teks Sekapur Sirih (ringkas)</label>
                    <textarea id="sekapur_teks" name="sekapur_teks" class="form-control" rows="4" maxlength="1000" placeholder="Kosong = teks bawaan">{{ old('sekapur_teks', Setting::value('sekapur_teks')) }}</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <h5 class="card-header">Kontak (footer)</h5>
            <div class="card-body row g-3">
                <div class="col-md-6"><label class="form-label" for="alamat">Alamat</label><input type="text" id="alamat" name="alamat" class="form-control" value="{{ old('alamat', Setting::value('alamat')) }}" placeholder="Jl. Nakula I no 5-11 Semarang"></div>
                <div class="col-md-6"><label class="form-label" for="telepon">Telepon</label><input type="text" id="telepon" name="telepon" class="form-control" value="{{ old('telepon', Setting::value('telepon')) }}" placeholder="+62 888-890-1090"></div>
                <div class="col-md-6"><label class="form-label" for="instagram_url">URL Instagram</label><input type="url" id="instagram_url" name="instagram_url" class="form-control" value="{{ old('instagram_url', Setting::value('instagram_url')) }}"></div>
                <div class="col-md-6"><label class="form-label" for="whatsapp_url">URL WhatsApp</label><input type="url" id="whatsapp_url" name="whatsapp_url" class="form-control" value="{{ old('whatsapp_url', Setting::value('whatsapp_url')) }}" placeholder="https://wa.me/628888901090"></div>
            </div>
        </div>

        <div class="card mb-4">
            <h5 class="card-header">Tautan</h5>
            <div class="card-body row g-3">
                <div class="col-md-6"><label class="form-label" for="survey_url">URL Survey</label><input type="url" id="survey_url" name="survey_url" class="form-control" value="{{ old('survey_url', Setting::value('survey_url')) }}"></div>
                <div class="col-md-6"><label class="form-label" for="cerdas_url">URL Cerdas Berkarakter</label><input type="url" id="cerdas_url" name="cerdas_url" class="form-control" value="{{ old('cerdas_url', Setting::value('cerdas_url')) }}"></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
