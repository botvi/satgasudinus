@extends('template-web.layout')
@section('title', 'Kegiatan — Satgas PPK UDINUS')
@section('content')
<div data-view="kegiatan">
  <header class="phead">
    <div class="wrap phead__in">
      <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li aria-current="page">Kegiatan</li></ol></nav>
      <h1>Kegiatan</h1>
      <p>Seminar, sosialisasi, dan edukasi Satgas PPK UDINUS.</p>
    </div>
  </header>
  <div class="page-body">
    <div class="wrap">
      @if ($kegiatans->isEmpty())
      <p class="empty">Belum ada kegiatan yang tersedia saat ini.</p>
      @else
      <div class="ggrid">
        @foreach ($kegiatans as $kegiatan)
        <article class="gcard">
          <div class="ph"><img src="{{ asset('kegiatan/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->title }}" loading="lazy"></div>
          <div class="gcard__body">
            <h3><a href="{{ $kegiatan->url }}">{{ $kegiatan->title }}</a></h3>
            <p>{{ $kegiatan->ringkasan }}</p>
          </div>
        </article>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
