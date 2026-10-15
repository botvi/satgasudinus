@extends('template-web.layout')
@section('title', 'Lainnya — Satgas PPK UDINUS')
@section('content')
<div data-view="lainnya">
  <header class="phead">
    <div class="wrap phead__in">
      <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li aria-current="page">Lainnya</li></ol></nav>
      <h1>Lainnya</h1>
      <p>Tautan dan layanan tambahan dari Satgas PPK UDINUS.</p>
    </div>
  </header>
  <div class="page-body">
    <div class="wrap">
      <div class="lgrid">
        <a class="acard acard--sm" href="/satgas/galeri" data-tilt>
          <h3>Galeri</h3>
          <div class="acard__scene"><div class="stack" aria-hidden="true">
            <svg viewBox="0 0 240 200" style="--z:0px"><ellipse cx="120" cy="188" rx="70" ry="6" fill="#0E1631" opacity=".14"/><g transform="rotate(-9 120 100)"><rect x="48" y="38" width="112" height="88" rx="6" fill="#D7E3FF" stroke="#1E3A8A" stroke-width="3"/></g></svg>
            <svg viewBox="0 0 240 200" style="--z:30px"><rect x="76" y="54" width="116" height="92" rx="6" fill="#fff" stroke="#1E3A8A" stroke-width="3"/><circle cx="106" cy="84" r="9" fill="#FFC857" stroke="#1E3A8A" stroke-width="3"/><path d="M84 138 L110 106 L128 126 L142 112 L184 138 Z" fill="#3FD3B5" stroke="#1E3A8A" stroke-width="3" stroke-linejoin="round"/></svg>
          </div></div>
          <p>Foto dan dokumentasi kegiatan Satgas PPK UDINUS.</p>
          <span class="go">Buka galeri</span>
        </a>
        <a class="acard acard--sm" href="{{ \App\Models\Setting::value('cerdas_url', 'https://belajarbersama-cerdasberkarakter.kemdikbud.go.id/') }}" data-tilt>
          <h3>Cerdas Berkarakter</h3>
          <div class="acard__scene"><div class="stack" aria-hidden="true">
            <svg viewBox="0 0 240 200" style="--z:0px"><ellipse cx="120" cy="188" rx="70" ry="6" fill="#0E1631" opacity=".14"/><circle cx="120" cy="96" r="70" fill="#E6EDFC"/></svg>
            <svg viewBox="0 0 240 200" style="--z:30px"><g transform="translate(120 96)">
              <ellipse cx="0" cy="-26" rx="15" ry="30" fill="#F5C518" stroke="#fff" stroke-width="2"/>
              <ellipse cx="0" cy="-26" rx="15" ry="30" fill="#3DB36B" stroke="#fff" stroke-width="2" transform="rotate(90)"/>
              <ellipse cx="0" cy="-26" rx="15" ry="30" fill="#E94B3C" stroke="#fff" stroke-width="2" transform="rotate(180)"/>
              <ellipse cx="0" cy="-26" rx="15" ry="30" fill="#3FA7E0" stroke="#fff" stroke-width="2" transform="rotate(270)"/>
              <circle r="7" fill="#fff"/></g></svg>
          </div></div>
          <p>Tautan ke laman Cerdas Berkarakter.</p>
          <span class="go">Kunjungi</span>
        </a>
        <a class="acard acard--sm" href="{{ \App\Models\Setting::value('survey_url', 'https://forms.gle/rWLVyy4jd1yng9Z77') }}" data-tilt>
          <h3>Survey</h3>
          <div class="acard__scene"><div class="stack" aria-hidden="true">
            <svg viewBox="0 0 240 200" style="--z:0px"><ellipse cx="120" cy="188" rx="84" ry="6" fill="#0E1631" opacity=".14"/><path d="M30 160h180l10 15H20z" fill="#C9CFE2" stroke="#1E3A8A" stroke-width="3" stroke-linejoin="round"/><rect x="46" y="62" width="148" height="100" rx="8" fill="#E07B2E" stroke="#1E3A8A" stroke-width="3"/></svg>
            <svg viewBox="0 0 240 200" style="--z:30px"><rect x="68" y="28" width="104" height="104" rx="8" fill="#fff" stroke="#1E3A8A" stroke-width="3"/><g stroke="#1E3A8A" stroke-width="2.5" fill="#fff"><rect x="82" y="50" width="12" height="12" rx="2"/><rect x="82" y="72" width="12" height="12" rx="2"/><rect x="82" y="94" width="12" height="12" rx="2"/></g><path d="M85 56l3 3 5-6M85 78l3 3 5-6" stroke="#E07B2E" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/><path d="M102 56h54M102 78h54M102 100h36" stroke="#C9CFE2" stroke-width="3" stroke-linecap="round"/></svg>
          </div></div>
          <p>Isi survei dari Satgas PPK UDINUS.</p>
          <span class="go">Isi survei</span>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
