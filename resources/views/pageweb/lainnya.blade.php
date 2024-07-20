@extends('template-web.layout')

@section('content')
<div class="mx-auto mt-24 max-w-6xl p-10 my-5">
  <h1 class="text-2xl font-bold mb-8 text-center">Lainnya</h1>

  <div class="container mx-auto px-6 mb-72">
    <div class="md:flex mt-8 md:-mx-4">
        <div class="w-full h-64 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:w-1/2" style="background-image: url('{{ asset('web') }}/assets/survei.jpg');">
            <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                <div class="px-10 max-w-xl">
                    <h2 class="text-2xl text-white font-semibold">SURVEI SATGAS UDINUS</h2>
                    <p class="mt-2 text-gray-100">Survei Pemahaman Kekerasan Seksual di Kampus UDINUS</p>
                    <a href="https://docs.google.com/forms/d/1eARSlJ4gyXLoJerwjw90xshdLBFDxSSw-MILKu3MxXI/edit?usp=sharing_eil_se_dm&ts=66985733">
                      <button class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                          <span>Survei Satgas</span>
                          <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                      </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full h-64 mt-8 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:mt-0 md:w-1/2" style="background-image: url('{{ asset('web') }}/assets/survei2.jpg');">
            <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                <div class="px-10 max-w-xl">
                    <h2 class="text-2xl text-white font-semibold">SURVEI SATGAS DINUS INSIDE</h2>
                    <p class="mt-2 text-gray-100">Survei Pemahaman Kekerasan Seksual Pada Masa Orientasi</p>
                  <a href="https://forms.gle/PSt9MrbJiGFoLBVd7">
                    <button class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                        <span>Survei Satgas</span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                  </a>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection