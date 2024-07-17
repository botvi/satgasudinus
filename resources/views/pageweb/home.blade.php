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
            <h2 class="text-2xl font-bold">Sekapur Sirih</h2>
            <div class="col-span-2 flex item-left">
                <div class="w-36 h-1 bg-gray-800 my-4"></div>
            </div>
            <p class="text-gray-700 text-justify">
                Mahasiswa berada di rentang usia 18-22 tahun, dimana mereka berada di tahap remaja akhir menuju perkembangan dewasa muda. Santrock (2011) menjelaskan bahwa pada masa ini, mahasiswa berusaha membentuk struktur kehidupannya sendiri dari berbagai sumber informasi dan pengalamannya. Pada masa remaja, seorang anak akan mengalami perkembangan psikologis,
            </p>
            <div class="mt-16">
                <a href="satgas/pengantar" class="bg-gray-800 text-white p-2 rounded-md hover:bg-yellow-500 transition duration-300">Baca Selengkapnya</a>
            </div>
        </div>
    </section>
    
    <!-- Section 3: Kegiatan -->
    <section class="p-10">
        <h2 class="text-2xl font-bold">Kegiatan</h2>
        <div class="col-span-2 flex item-left">
                <div class="w-24 h-1 bg-gray-800 my-4"></div>
            </div>
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
                <h2 class="text-2xl font-bold">Lapor</h2>
                <div class="col-span-2 flex item-left">
                  <div class="w-16 h-1 bg-gray-800 my-4"></div>
                </div>
                <p class="text-gray-700 mb-16 text-justify">
                    Universitas Dian Nuswantoro berkomitmen untuk melakukan pencegahan dan penanganan segala bentuk kekerasan seksual yang terjadi di lingkungan kampus UDINUS. Laporkan segala bentuk tindak kekerasan seksual ke Tim Satgas PPKS UDINUS melalui link dibawah ini.
                </p>
                <div class="mt-28">
                    <a href="/satgas/lapor" class="bg-gray-800 text-white p-2 rounded-md hover:bg-yellow-500 transition duration-300">Lapor Sekarang</a>
                </div>
            </div>
            <div class="col-span-1 md:col-span-1">
                <img src="{{ asset('web') }}/assets/cover3.jpg" alt="Gambar Lapor" class="w-full h-72 md:h-auto rounded-md shadow-md object-cover object-center">
            </div>
        </div>
    </section>
    
    <!-- Section 5: Dokumen -->
    <section class="p-10">
        <h2 class="text-2xl font-bold">Akses</h2>
            <div class="col-span-2 flex item-left">
                <div class="w-16 h-1 bg-gray-800 my-4"></div>
            </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                <img class="w-auto item-center h-72 rounded-t-xl" src="{{ asset('web') }}/assets/dokumen.png">
                <div class="p-4 md:p-5">
                    <h3 class="text-lg font-bold text-gray-800">
                        SK UDINUS 2024
                    </h3>
                    <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-800 text-white p-2 rounded-md hover:bg-yellow-500 transition duration-300" href="satgas/dokumen">
                        DOKUMEN SATGAS
                    </a>
                </div>
            </div>
        
            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                <img class="w-auto item-center h-72 rounded-t-xl" src="{{ asset('web') }}/assets/cerdas.jpg">
                <div class="p-4 md:p-5">
                    <h3 class="text-lg font-bold text-gray-800">
                        CERDAS BERKARAKTER
                    </h3>
                    <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-800 text-white p-2 rounded-md hover:bg-yellow-500 transition duration-300" href="https://belajarbersama-cerdasberkarakter.kemdikbud.go.id/">
                        CERDAS BERKARAKTER
                    </a>
                </div>
            </div>
        
            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                <img class="w-auto item-center h-72 rounded-t-xl" src="{{ asset('web') }}/assets/survey.png" alt="Image Description">
                <div class="p-4 md:p-5">
                    <h3 class="text-lg font-bold text-gray-800">
                        SURVEY
                    </h3>
                    <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-800 text-white p-2 rounded-md hover:bg-yellow-500 transition duration-300" href="satgas/lainnya">
                        SURVEY SATGAS
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Video -->
    <section class="p-10 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="flex justify-center">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/Ev_ZeKkEEdY?si=2ypPZfGJ-Y4atwtP" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="col-span-1 md:col-span-1">
            <h2 class="text-2xl font-bold">Kanal  Youtube</h2>
            <div class="col-span-2 flex item-left">
                <div class="w-40 h-1 bg-gray-800 my-4"></div>
            </div>
            <p class="text-gray-700 text-justify">
                Mahasiswa berada di rentang usia 18-22 tahun, dimana mereka berada di tahap remaja akhir menuju perkembangan dewasa muda. Santrock (2011) menjelaskan bahwa pada masa ini, mahasiswa berusaha membentuk struktur kehidupannya sendiri dari berbagai sumber informasi dan pengalamannya. Pada masa remaja, seorang anak akan mengalami perkembangan psikologis,
            </p>
            <div class="mt-16">
                <a href="https://www.youtube.com/@MalakaProjectid" class="bg-gray-800 text-white p-2 rounded-md hover:bg-yellow-500 transition duration-300">Kanal Youtube</a>
            </div>
        </div>
    </section>
</div>
@endsection
