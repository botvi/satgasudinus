@extends('template-web.layout')
@section('content')
<div class="mx-auto max-w-6xl my-5">
    <!-- Section 1: Welcome Banner -->
    <section class="relative bg-cover bg-center h-96 mt-32" style="background-image: url('{{ asset('web') }}/assets/cover.jpg');">
      <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
      <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
          <h1 class="text-2xl md:text-4xl text-white font-bold">Selamat Datang di Satgas PPKS UDINUS</h1>
          <p class="mt-2 md:mt-4 text-sm md:text-lg text-white">Portal Informasi Satgas PPKS Universitas Dian Nuswantoro</p>
      </div>
  </section>
  
    <!-- Section 2: Pengantar -->
    <section class="p-10 grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="col-span-1 md:col-span-1">
        <img src="{{ asset('web') }}/assets/cover2.jpg" alt="Foto Pengantar" class="w-full h-48 md:h-72 rounded-md shadow-md">
      </div>
      <div class="col-span-1 md:col-span-1">
        <h2 class="text-2xl font-bold mb-4">Sekapur Sirih</h2>
        <p class="text-gray-700">
          Mahasiswa berada di rentang usia 18-22 tahun, dimana mereka berada di tahap remaja akhir menuju perkembangan dewasa muda. Santrock (2011) menjelaskan bahwa pada masa ini, mahasiswa berusaha membentuk struktur kehidupannya sendiri dari berbagai sumber informasi dan pengalamannya. Pada masa remaja, seorang anak akan mengalami perkembangan psikologis,
        </p>
        <div class="mt-8">
          <a href="Pengantar.html" class="bg-gray-800 text-white p-2 rounded-md hover:bg-yellow-500 transition duration-300">Baca Selengkapnya</a>
        </div>
      </div>
  </section>
  
  
  <!-- Section 3: Kegiatan -->
<section class="p-10">
  <h2 class="text-2xl font-bold mb-4">Kegiatan</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach ($kegiatan as $item)
      <div class="bg-white shadow-md rounded-lg overflow-hidden">
          <img src="{{ asset('kegiatan/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
          <div class="p-4">
              <h3 class="text-xl font-bold mb-2">{{ $item->judul }}</h3>
              <p class="text-gray-700">{{ $item->deskripsi }}</p>
          </div>
      </div>
      @endforeach
  </div>
</section>


  
    <!-- Section 4: Lapor -->
    <section class="p-10">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="col-span-1 md:col-span-1">
          <h2 class="text-2xl font-bold mb-4">Lapor</h2>
          <p class="text-gray-700">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac ex nec felis faucibus ullamcorper. Ut
            hendrerit nunc ac eros euismod, eget fermentum ipsum consequat. Duis vehicula suscipit odio, nec dignissim
            odio sagittis et. Sed accumsan massa nec consequat ultrices. Nulla facilisi. Nam vel leo nec tellus iaculis
            rutrum sed at erat. Vestibulum consequat lectus sed leo pretium varius. Vestibulum dapibus felis eu est
            finibus.
          </p>
          <div class="mt-4">
            <a href="/satgas/lapor" class="bg-red-500 text-white p-2 rounded-md hover:bg-yellow-500 transition duration-300">Lapor Sekarang</a>
          </div>
        </div>
        <div class="col-span-1 md:col-span-1">
          <img src="https://via.placeholder.com/300" alt="Gambar Lapor" class="w-full h-60 md:max-w-full rounded-md shadow-md">
        </div>
      </div>
    </section>
  
  <!-- Section 5: Dokumen -->
<section class="p-10">
  <h2 class="text-2xl font-bold mb-4">Dokumen</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach ($dokumen as $item)
      <div class="bg-white shadow-md rounded-lg overflow-hidden">
          <div class="p-4 flex items-center">
              <div class="mr-4">
                  <i class="fas fa-file-pdf text-gray-800 text-6xl"></i>
              </div>
              <div class="flex-1">
                  <h3 class="text-xl font-bold mb-2">{{ $item->judul }}</h3>
                  <p class="text-gray-700 mb-4">{{ $item->deskripsi }}</p>
                  <a href="{{ asset('dokumen/' . $item->file) }}" class="block bg-gray-800 text-white p-2 rounded-md mt-14 text-center hover:bg-yellow-500 transition duration-300">UNDUH</a>
              </div>
          </div>
      </div>
      @endforeach
  </div>
</section>


 <!-- Section 6: Galeri -->
<section class="p-10">
  <h2 class="text-2xl font-bold mb-4">Galeri</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach ($galeri as $item)
      <div class="bg-white shadow-md rounded-lg overflow-hidden zoom">
          <img src="{{ asset('galeri/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
      </div>
      @endforeach
  </div>
</section>


  </div>
  @endsection