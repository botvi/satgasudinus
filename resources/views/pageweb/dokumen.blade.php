@extends('template-web.layout')

@section('content')
<div class="container mx-auto max-w-6xl mb-32 mt-24 p-10 my-5">
  <h1 class="text-2xl font-bold mb-8 text-center">Dokumen</h1>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @if($dokumens->isEmpty())
      <div class="col-span-1 md:col-span-3 text-center">
        <p class="text-gray-700">Tidak ada dokumen yang tersedia saat ini.</p>
      </div>
    @else
      @foreach($dokumens as $dokumen)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
          <div class="p-4 flex items-center">
            <div class="mr-4">
              <i class="fas fa-file-pdf text-gray-800 text-6xl"></i>
            </div>
            <div class="flex-1">
              <h3 class="text-xl font-bold mb-2">{{ $dokumen->title }}</h3>
              <p class="text-gray-700 mb-4">{{ $dokumen->deskripsi }}</p>
              <a href="{{ asset('dokumen/' . $dokumen->file) }}" class="block bg-gray-800 text-white p-2 rounded-md mt-4 text-center hover:bg-yellow-500 transition duration-300">UNDUH</a>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
</div>
@endsection
