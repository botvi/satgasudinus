@extends('template-web.layout')

@section('content')
<div class="mx-auto mt-24 max-w-6xl p-10 my-5">
  <h1 class="text-2xl font-bold mb-8 text-center">Galeri</h1>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @if($galeris->isEmpty())
      <div class="col-span-1 md:col-span-4 text-center">
        <p class="text-gray-700">Tidak ada gambar yang tersedia saat ini.</p>
      </div>
    @else
      @foreach($galeris as $galeri)
        <div class="relative overflow-hidden rounded-md shadow-md">
          <img src="{{ asset('galeri/' . $galeri->gambar) }}" alt="Foto {{ $loop->iteration }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
        </div>
      @endforeach
    @endif
  </div>
</div>
@endsection
