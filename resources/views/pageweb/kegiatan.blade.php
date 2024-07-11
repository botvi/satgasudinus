@extends('template-web.layout')

@section('content')
<div class="mx-auto mt-24 max-w-6xl p-10 my-5">
  <h1 class="text-2xl font-bold mb-8 text-center">Kegiatan</h1>
  <div id="kegiatan-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @if($kegiatans->isEmpty())
      <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center">
        <p class="text-gray-700">Tidak ada kegiatan yang tersedia saat ini.</p>
      </div>
    @else
      @foreach($kegiatans as $kegiatan)
        <div class="bg-white shadow-md rounded-md overflow-hidden">
          <img src="{{ asset('kegiatan/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->title }}" class="w-full h-48 object-cover" />
          <div class="p-4">
            <h2 class="text-xl font-bold mb-2">{{ $kegiatan->title }}</h2>
            <p class="text-gray-700">{{ $kegiatan->deskripsi }}</p>
          </div>
        </div>
      @endforeach
    @endif
  </div>
</div>
@endsection
