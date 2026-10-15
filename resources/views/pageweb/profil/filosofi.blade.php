@extends('template-web.layout')
@section('title', 'Filosofi Logo — Satgas PPK UDINUS')
@section('content')
<div data-view="filosofi">
  <header class="phead">
    <div class="wrap phead__in">
      <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li>Profil</li><li aria-current="page">Filosofi</li></ol></nav>
      <h1>Filosofi Logo</h1>
      <p>Makna di balik bentuk dan warna pada logo Satgas PPKS UDINUS.</p>
    </div>
  </header>
  <div class="page-body">
    <div class="wrap fil">
      <div class="fil__logo">
        <div class="logo-stage" data-logo-stage>
          <div class="logo-card">
            <div class="logo-img logo-big" role="img" aria-label="Logo Satgas PPKS UDINUS"></div>
          </div>
        </div>
      </div>

      <div class="fil__copy">
        <h2 class="sec-title">Makna logo</h2>
        <div class="parts">
          <div class="part is-open" data-part="heart">
            <h3><button type="button" aria-expanded="true" aria-controls="part-heart">Simbol Hati</button></h3>
            <div class="part__body" id="part-heart"><p>Elemen berbentuk hati melambangkan empati, kepedulian, serta dukungan untuk melindungi dan memberikan rasa aman kepada seluruh civitas akademika Universitas Dian Nuswantoro. Hal ini mencerminkan tujuan Satgas PPKS yang fokus pada kesejahteraan, perlindungan serta kebersamaan untuk melawan segala bentuk kekerasan dan hal-hal yang berpotensi merusak sebuah harmonisasi kehidupan di lingkungan kampus.</p></div>
          </div>
          <div class="part" data-part="hands">
            <h3><button type="button" aria-expanded="false" aria-controls="part-hands">Simbol Tangan</button></h3>
            <div class="part__body" id="part-hands" hidden><p>Elemen orang yang merangkul dan tangan yang terbuka melambangkan perlindungan, dukungan, pertolongan, serta kekuatan. Hal ini mencerminkan komitmen untuk bertindak secara proaktif dan preventif.</p></div>
          </div>
          <div class="part" data-part="red">
            <h3><button type="button" aria-expanded="false" aria-controls="part-red">Warna Merah</button></h3>
            <div class="part__body" id="part-red" hidden><p>Warna merah melambangkan keberanian, semangat energi yang tinggi, serta perhatian dan kepedulian. Hal ini mencerminkan bahwa Satgas PPKS siap dan berkomitmen dalam menangani masalah kekerasan seksual guna menciptakan lingkungan yang aman positif bagi semua civitas akademika Universitas Dian Nuswantoro.</p></div>
          </div>
          <div class="part" data-part="blue">
            <h3><button type="button" aria-expanded="false" aria-controls="part-blue">Warna Biru</button></h3>
            <div class="part__body" id="part-blue" hidden><p>Warna biru melambangkan kepercayaan, profesionalisme, dan ketenangan. Hal ini menunjukkan bahwa Satgas PPKS bertindak dengan integritas, dedikasi, dan ketenangan dalam menjalankan tanggung jawabnya untuk melindungi dan mendukung civitas akademika Universitas Dian Nuswantoro.</p></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
@section('script')
<script>
(function () {
  'use strict';
  var reduce = function () { return window.matchMedia('(prefers-reduced-motion: reduce)').matches || document.documentElement.classList.contains('a11y-calm'); };
  var $ = function (q, r) { return (r || document).querySelector(q); };
  var $$ = function (q, r) { return Array.prototype.slice.call((r || document).querySelectorAll(q)); };
  var fil = $('[data-view="filosofi"]');
  function openPart(key) {
    $$('.part', fil).forEach(function (p) {
      var on = p.getAttribute('data-part') === key;
      p.classList.toggle('is-open', on);
      p.querySelector('button').setAttribute('aria-expanded', String(on));
      p.querySelector('.part__body').hidden = !on;
    });
    $$('.hl', fil).forEach(function (h) { h.classList.toggle('is-on', h.getAttribute('data-hl') === key); });
  }
  $$('.part button', fil).forEach(function (b) {
    b.addEventListener('click', function () { openPart(b.closest('.part').getAttribute('data-part')); });
  });
  var lstage = $('[data-logo-stage]'), lcard = $('.logo-card', lstage);
  {
    lstage.addEventListener('pointermove', function (e) {
      if (reduce()) return;
      var r = lstage.getBoundingClientRect();
      var x = (e.clientX - r.left) / r.width - .5, y = (e.clientY - r.top) / r.height - .5;
      lcard.style.transform = 'rotateX(' + (-y * 14).toFixed(2) + 'deg) rotateY(' + (x * 18).toFixed(2) + 'deg)';
    });
    lstage.addEventListener('pointerleave', function () { lcard.style.transform = ''; });
  }

  /* ---------- Router (hash) ---------- */
  var TITLES = {
    home: 'Satgas PPK UDINUS — Portal Informasi', pengantar: 'Sekapur Sirih — Satgas PPK UDINUS',
    filosofi: 'Filosofi Logo — Satgas PPK UDINUS', kegiatan: 'Kegiatan — Satgas PPK UDINUS',
    dokumen: 'Dokumen — Satgas PPK UDINUS', lainnya: 'Lainnya — Satgas PPK UDINUS', lapor: 'Lapor — Satgas PPK UDINUS', faq: 'FAQ — Satgas PPK UDINUS'
  };
  var NAVKEY = { home: 'home', pengantar: 'profil', filosofi: 'profil', kegiatan: 'kegiatan', detail: 'kegiatan', dokumen: 'dokumen', lainnya: 'lainnya', lapor: 'lapor', faq: 'faq' };
  var PAGES = ['pengantar', 'filosofi', 'kegiatan', 'dokumen', 'lainnya', 'lapor', 'faq'];
})();
</script>
@endsection