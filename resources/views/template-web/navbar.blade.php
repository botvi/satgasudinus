<a class="skip" href="#konten">Lewati ke konten</a>
<!-- ================= HEADER ================= -->
<header class="site-header">
  <div class="wrap bar">
    <a class="brand" href="/" aria-label="Satuan Tugas PPK UDINUS, ke beranda">
      <span class="logo-img" role="img" aria-label="Logo Satgas PPKS UDINUS"></span>
      <span class="brand__txt">Satuan Tugas<br>PPK UDINUS</span>
    </a>

    <nav class="nav" id="nav" aria-label="Navigasi utama">
      <ul>
        <li><a href="/" {{ request()->is('/') ? 'aria-current=page' : '' }} data-nav="home">Beranda</a></li>
        <li class="has-sub">
          <button class="sub-toggle {{ request()->is('satgas/pengantar','satgas/filosofi') ? 'is-current' : '' }}" type="button" data-nav="profil" aria-expanded="false" aria-controls="menu-profil">
            Profil
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <ul class="sub" id="menu-profil">
            <li><a href="/satgas/pengantar">Pengantar</a></li>
            <li><a href="/satgas/filosofi">Filosofi</a></li>
          </ul>
        </li>
        <li><a href="/satgas/kegiatan" {{ request()->is('satgas/kegiatan') ? 'aria-current=page' : '' }} data-nav="kegiatan">Kegiatan</a></li>
        <li><a href="/satgas/dokumen" {{ request()->is('satgas/dokumen') ? 'aria-current=page' : '' }} data-nav="dokumen">Dokumen</a></li>
        <li><a href="/satgas/faq" {{ request()->is('satgas/faq') ? 'aria-current=page' : '' }} data-nav="faq">FAQ</a></li>
        <li><a href="/satgas/lainnya" {{ request()->is('satgas/lainnya','satgas/galeri') ? 'aria-current=page' : '' }} data-nav="lainnya">Lainnya</a></li>
      </ul>
    </nav>

    <a class="btn btn--alert" href="/satgas/lapor">Laporkan</a>
    <button class="menu-btn" type="button" aria-expanded="false" aria-controls="nav" aria-label="Buka menu">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
    </button>
  </div>
</header>