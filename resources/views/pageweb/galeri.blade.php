@extends('template-web.layout')
@section('title', 'Galeri — Satgas PPK UDINUS')
@section('content')
<header class="phead">
  <div class="wrap phead__in">
    <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li aria-current="page">Galeri</li></ol></nav>
    <h1>Galeri</h1>
    <p>Foto dan dokumentasi kegiatan Satgas PPK UDINUS.</p>
  </div>
</header>
<div class="page-body">
  <div class="wrap">
    @if ($galeris->isEmpty())
    <p class="empty">Tidak ada gambar yang tersedia saat ini.</p>
    @else
    <div class="ggrid">
      @foreach ($galeris as $galeri)
      <article class="gcard"><div class="ph" style="aspect-ratio:4/3"><img src="{{ asset('galeri/' . $galeri->gambar) }}" alt="Foto {{ $loop->iteration }}" loading="lazy"></div></article>
      @endforeach
    </div>
    @endif
  </div>
</div>
@endsection
