@extends('template-web.layout')
@section('title', $kegiatan->title . ' — Satgas PPK UDINUS')
@section('content')
<header class="phead">
  <div class="wrap phead__in">
    <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li><a href="/satgas/kegiatan">Kegiatan</a></li><li aria-current="page">{{ \Illuminate\Support\Str::limit($kegiatan->title, 44) }}</li></ol></nav>
    <h1 class="is-long">{{ $kegiatan->title }}</h1>
  </div>
</header>
<div class="page-body">
  <div class="wrap detail">
    <article class="detail__main">
      @if ($kegiatan->video)
      <div class="detail__cover detail__video">
        <video controls preload="metadata" playsinline poster="{{ asset('kegiatan/' . ($kegiatan->video_poster ?: $kegiatan->gambar)) }}"><source src="{{ asset('kegiatan/' . $kegiatan->video) }}"></video>
      </div>
      @else
      <div class="ph detail__cover"><img src="{{ asset('kegiatan/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->title }}"></div>
      @endif
      <div class="prose">{!! $kegiatan->isi_html !!}</div>
      @if ($kegiatan->media->isNotEmpty())
      @php $n = $kegiatan->media->count(); @endphp
      <section class="gal" aria-roledescription="carousel" aria-label="Dokumentasi kegiatan">
        <div class="gal__head"><h2>Dokumentasi</h2><div class="gal__ctl"><span class="gal__count" aria-live="polite"></span>
          <button class="gal__btn" type="button" data-dir="-1" aria-label="Sebelumnya"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg></button>
          <button class="gal__btn" type="button" data-dir="1" aria-label="Berikutnya"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg></button></div></div>
        <div class="gal__track" tabindex="0" aria-label="Geser untuk melihat dokumentasi lainnya">
          @foreach ($kegiatan->media as $m)
          <figure class="gal__slide" role="group" aria-roledescription="slide" aria-label="{{ $loop->iteration }} dari {{ $n }}">
            <div class="ph">
              @if ($m->type === 'video')
              <video controls preload="metadata" playsinline @if ($m->poster) poster="{{ asset('kegiatan/' . $m->poster) }}" @endif><source src="{{ asset('kegiatan/' . $m->file) }}"></video>
              @else
              <img src="{{ asset('kegiatan/' . $m->file) }}" alt="Dokumentasi {{ $loop->iteration }}" loading="lazy" draggable="false">
              @endif
            </div>
          </figure>
          @endforeach
        </div>
        <div class="gal__dots">@foreach ($kegiatan->media as $m)<button class="gal__dot" type="button" aria-label="Ke dokumentasi {{ $loop->iteration }}"></button>@endforeach</div>
      </section>
      @endif
    </article>
    <aside class="detail__side">
      <section class="info" aria-labelledby="info-h">
        <h2 id="info-h">Info kegiatan</h2>
        <dl>
          <div><dt>Penyelenggara</dt><dd>{{ $kegiatan->penyelenggara ?: 'Satgas PPK UDINUS' }}</dd></div>
          @if ($kegiatan->kategori)<div><dt>Kategori</dt><dd>{{ $kegiatan->kategori }}</dd></div>@endif
          @if ($kegiatan->tanggal)<div><dt>Tanggal</dt><dd>{{ $kegiatan->tanggal->locale('id')->translatedFormat('j F Y') }}</dd></div>@endif
          @if ($kegiatan->tempat)<div><dt>Tempat</dt><dd>{{ $kegiatan->tempat }}</dd></div>@endif
        </dl>
      </section>
      @if ($lain->isNotEmpty())
      <section class="rel" aria-labelledby="rel-h">
        <h2 id="rel-h">Kegiatan lainnya</h2>
        @foreach ($lain as $o)
        <a href="{{ $o->url }}"><div class="ph"><img src="{{ asset('kegiatan/' . $o->gambar) }}" alt=""></div><span>{{ $o->title }}</span></a>
        @endforeach
      </section>
      @endif
    </aside>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('web/gallery.js') }}?v={{ filemtime(public_path('web/gallery.js')) }}"></script>
@endsection
