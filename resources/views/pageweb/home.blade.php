@extends('template-web.layout')
@section('title', 'Satgas PPK UDINUS — Portal Informasi')
@section('content')

<!-- ================= HERO ================= -->
<section class="hero" id="beranda" aria-labelledby="judul-hero">
  <div class="wrap">
    <div class="hero__copy">
      <h1 class="hero__title" id="judul-hero">
        <span class="line"><span style="--i:0">Selamat Datang</span></span>
        <span class="line"><span style="--i:1">di Laman</span></span>
        <span class="line"><span style="--i:2">Satgas PPK</span></span>
        <span class="line"><span style="--i:3">UDINUS</span></span>
      </h1>
      <p class="hero__sub">Portal Informasi Satgas PPK Universitas Dian Nuswantoro</p>
      <div class="hero__cta">
        <a class="btn btn--alert btn--lg" href="/satgas/lapor">Laporkan sekarang</a>
        <a class="btn btn--ghost btn--lg" href="#sekapur">Kenali Satgas PPK</a>
      </div>
    </div>
  </div>

  <div class="stage hero__stage" data-stage="hero" aria-hidden="true">
    <canvas></canvas>
    <!-- Fallback bila WebGL tidak tersedia -->
    <div class="fallback"><span class="logo-img" role="img" aria-label="Logo Satgas PPKS UDINUS"></span></div>
  </div>
</section>

<!-- ================= SEKAPUR SIRIH ================= -->
<section class="sec sekapur" id="sekapur" aria-labelledby="judul-sekapur">
  <div class="wrap sekapur__grid">
    <figure class="video">
      <div class="video__frame">
        @if ($vid = \App\Models\Setting::value('video_profil'))
        <video controls preload="none" playsinline aria-label="Video profil Satgas PPK UDINUS" @if ($pos = \App\Models\Setting::value('video_profil_poster')) poster="{{ asset('video/' . $pos) }}" @endif><source src="{{ asset('video/' . $vid) }}"></video>
        @else
        <img src="{{ asset('env/cover2.jpg') }}" alt="Satgas PPK UDINUS" loading="lazy">
        @endif
      </div>
    </figure>

    <div class="sekapur__copy">
      <h2 class="sec-title" id="judul-sekapur">Sekapur Sirih</h2>
      <p class="lead">{{ \App\Models\Setting::value('sekapur_teks', 'Pusat Pencegahan dan Penanganan Kekerasan (PPK) PT UDINUS merupakan unit resmi universitas yang berkomitmen menciptakan lingkungan kampus yang aman, inklusif, dan bermartabat bagi seluruh sivitas akademika.') }}</p>
      <a class="link" href="/satgas/pengantar">Baca selengkapnya</a>
    </div>
  </div>
</section>

<!-- ================= KEGIATAN ================= -->
<section class="sec" id="kegiatan" style="padding-top:0" aria-labelledby="judul-kegiatan">
  <div class="wrap">
    <h2 class="sec-title" id="judul-kegiatan">Kegiatan</h2>

    <div class="kgrid">
      @foreach ($kegiatan as $item)
      <article class="kcard {{ $loop->first ? 'kcard--lead' : 'kcard--side' }}">
        <div class="ph"><img src="{{ asset('kegiatan/' . $item->gambar) }}" alt="{{ $item->title }}" loading="lazy"></div>
        <div class="kcard__body">
          <h3><a href="{{ $item->url }}">{{ $item->title }}</a></h3>
          <p>{{ $item->ringkasan }}</p>
        </div>
      </article>
      @endforeach
    </div>

    <a class="link" href="/satgas/kegiatan">Baca selengkapnya</a>
  </div>
</section>

<!-- ================= LAPOR ================= -->
<section class="lapor" id="lapor" aria-labelledby="judul-lapor">
  <div class="wrap lapor__grid">
    <div class="lapor__copy">
      <h2 class="sec-title" id="judul-lapor">Lapor</h2>
      <p>Universitas Dian Nuswantoro berkomitmen untuk melakukan pencegahan dan penanganan segala bentuk kekerasan seksual yang terjadi di lingkungan kampus UDINUS. Laporkan segala bentuk tindak kekerasan seksual ke Tim Satgas PPK UDINUS melalui tombol Laporkan di bagian atas halaman.</p>
    </div>
    <div class="lapor__media">
      <div class="ph"><img src="{{ asset('env/cover3.jpg') }}" alt="Satgas PPK UDINUS" loading="lazy"></div>
      <div class="stage lapor__stage" data-stage="lapor" aria-hidden="true"><canvas></canvas></div>
    </div>
  </div>
</section>

<!-- ================= AKSES ================= -->
<section class="sec" id="akses" aria-labelledby="judul-akses">
  <div class="wrap">
    <h2 class="sec-title" id="judul-akses">Akses</h2>

    <div class="agrid">
      <!-- Dokumen Satgas -->
      <a class="acard" href="/satgas/dokumen" data-tilt>
        <h3>Dokumen Satgas</h3>
        <div class="acard__scene">
          <div class="stack" aria-hidden="true">
            <svg viewBox="0 0 240 200" style="--z:0px"><ellipse cx="120" cy="188" rx="72" ry="6" fill="#0E1631" opacity=".14"/><circle cx="130" cy="98" r="70" fill="#3FD3B5"/></svg>
            <svg viewBox="0 0 240 200" style="--z:26px">
              <rect x="58" y="40" width="98" height="120" rx="7" fill="#D7E3FF" stroke="#1E3A8A" stroke-width="3"/>
              <rect x="72" y="30" width="98" height="120" rx="7" fill="#fff" stroke="#1E3A8A" stroke-width="3"/>
              <rect x="86" y="44" width="30" height="26" fill="#FFC857" stroke="#1E3A8A" stroke-width="3"/>
              <path d="M86 86h72M86 100h72M86 114h56M86 128h64" stroke="#1E3A8A" stroke-width="3" stroke-linecap="round"/>
            </svg>
            <svg viewBox="0 0 240 200" style="--z:54px">
              <g transform="rotate(45 160 100)">
                <rect x="150" y="40" width="20" height="90" fill="#FF9F43" stroke="#1E3A8A" stroke-width="3"/>
                <path d="M150 130h20l-10 22z" fill="#FFE3B8" stroke="#1E3A8A" stroke-width="3" stroke-linejoin="round"/>
                <rect x="150" y="28" width="20" height="14" fill="#FF6B6B" stroke="#1E3A8A" stroke-width="3"/>
              </g>
            </svg>
          </div>
        </div>
      </a>

      <!-- Cerdas Berkarakter -->
      <a class="acard" href="{{ \App\Models\Setting::value('cerdas_url', 'https://belajarbersama-cerdasberkarakter.kemdikbud.go.id/') }}" data-tilt>
        <h3>Cerdas Berkarakter</h3>
        <div class="acard__scene">
          <div class="stack" aria-hidden="true">
            <svg viewBox="0 0 240 200" style="--z:0px"><ellipse cx="120" cy="188" rx="72" ry="6" fill="#0E1631" opacity=".14"/><circle cx="120" cy="86" r="70" fill="#E6EDFC"/></svg>
            <!-- Placeholder logo: ganti dengan logo resmi Cerdas Berkarakter -->
            <svg viewBox="0 0 240 200" style="--z:28px">
              <g transform="translate(120 86)">
                <ellipse cx="0" cy="-26" rx="15" ry="30" fill="#F5C518" stroke="#fff" stroke-width="2"/>
                <ellipse cx="0" cy="-26" rx="15" ry="30" fill="#3DB36B" stroke="#fff" stroke-width="2" transform="rotate(90)"/>
                <ellipse cx="0" cy="-26" rx="15" ry="30" fill="#E94B3C" stroke="#fff" stroke-width="2" transform="rotate(180)"/>
                <ellipse cx="0" cy="-26" rx="15" ry="30" fill="#3FA7E0" stroke="#fff" stroke-width="2" transform="rotate(270)"/>
                <circle r="7" fill="#fff"/>
              </g>
            </svg>
            <svg viewBox="0 0 240 200" style="--z:50px">
              <text x="120" y="172" text-anchor="middle" font-family="Bricolage Grotesque, Hanken Grotesk, sans-serif" font-weight="700" font-size="20" fill="#1E6FB0">Cerdas</text>
              <text x="120" y="194" text-anchor="middle" font-family="Bricolage Grotesque, Hanken Grotesk, sans-serif" font-weight="700" font-size="20" fill="#1E6FB0">Berkarakter</text>
            </svg>
          </div>
        </div>
      </a>

      <!-- Survey -->
      <a class="acard" href="/satgas/lainnya" data-tilt>
        <h3>Survey</h3>
        <div class="acard__scene">
          <div class="stack" aria-hidden="true">
            <svg viewBox="0 0 240 200" style="--z:0px">
              <ellipse cx="120" cy="188" rx="86" ry="6" fill="#0E1631" opacity=".14"/>
              <path d="M30 160h180l10 15H20z" fill="#C9CFE2" stroke="#1E3A8A" stroke-width="3" stroke-linejoin="round"/>
              <rect x="46" y="62" width="148" height="100" rx="8" fill="#E07B2E" stroke="#1E3A8A" stroke-width="3"/>
            </svg>
            <svg viewBox="0 0 240 200" style="--z:30px">
              <rect x="68" y="28" width="104" height="104" rx="8" fill="#fff" stroke="#1E3A8A" stroke-width="3"/>
              <text x="120" y="54" text-anchor="middle" font-family="Bricolage Grotesque, Hanken Grotesk, sans-serif" font-weight="800" font-size="16" fill="#0E1631">Survey</text>
              <g stroke="#1E3A8A" stroke-width="2.5" fill="#fff"><rect x="82" y="68" width="12" height="12" rx="2"/><rect x="82" y="88" width="12" height="12" rx="2"/><rect x="82" y="108" width="12" height="12" rx="2"/></g>
              <path d="M85 74l3 3 5-6M85 94l3 3 5-6" stroke="#E07B2E" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M102 74h54M102 94h54M102 114h36" stroke="#C9CFE2" stroke-width="3" stroke-linecap="round"/>
            </svg>
            <svg viewBox="0 0 240 200" style="--z:56px">
              <circle cx="176" cy="40" r="17" fill="#22A06B" stroke="#fff" stroke-width="3"/>
              <path d="M168 40l6 6 11-12" stroke="#fff" stroke-width="3.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </a>
    </div>
  </div>
</section>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
@endsection