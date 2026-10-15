@extends('template-web.layout')
@section('title', 'FAQ — Satgas PPK UDINUS')
@section('content')
<div data-view="faq">
  <header class="phead">
    <div class="wrap phead__in">
      <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li aria-current="page">FAQ</li></ol></nav>
      <h1>FAQ</h1>
      <p>Jawaban atas pertanyaan yang sering diajukan seputar pelaporan dan Satgas PPK UDINUS.</p>
    </div>
  </header>
  <div class="page-body">
    <div class="wrap faq">
      <div class="faq__main">
        <div class="faq__tools">
          <label class="search">
            <span class="sr">Cari pertanyaan</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            <input type="search" id="faq-search" placeholder="Cari pertanyaan" autocomplete="off">
          </label>
          <div class="gtoolbar" id="faq-chips" role="group" aria-label="Kategori pertanyaan"></div>
        </div>
        <p class="faq__count" id="faq-count" aria-live="polite"></p>
        <div class="faq__list" id="faq-list"></div>
        <p class="empty" id="faq-empty" hidden>Tidak ada pertanyaan yang cocok. Coba kata kunci lain atau pilih kategori Semua.</p>
      </div>
      <aside class="faq__side" aria-label="Bantuan lain">
        <section class="lp-card lp-card--calm">
          <h2>Belum menemukan jawabannya?</h2>
          <p>Hubungi Satgas PPK di <a href="tel:+628888901090">+62 888-890-1090</a> atau datang ke Jl. Nakula I no 5-11 Semarang.</p>
        </section>
      </aside>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
(function () {
  'use strict';
  var $ = function (q, r) { return (r || document).querySelector(q); };
  var $$ = function (q, r) { return Array.prototype.slice.call((r || document).querySelectorAll(q)); };
  var esc = function (t) { return String(t).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); };

  /* Jawaban diambil dari isi situs. Item bertanda [ ... ] perlu diisi jawaban resminya. */
  var FAQ = [
    { cat: 'Umum', q: 'Apa itu Satgas PPK UDINUS?',
      a: '<p>Satgas PPK adalah satuan tugas Pusat Pencegahan dan Penanganan Kekerasan (PPK) Universitas Dian Nuswantoro. Satgas PPK merupakan unit resmi universitas yang berkomitmen menciptakan lingkungan kampus yang aman, inklusif, dan bermartabat bagi seluruh sivitas akademika.</p><p>Selengkapnya ada di halaman <a href="/satgas/pengantar">Pengantar</a>.</p>' },
    { cat: 'Umum', q: 'Apa arti logo Satgas PPK?',
      a: '<p>Penjelasan tiap unsur logo, yaitu tangan, hati berbentuk sosok manusia, lingkaran, dan warnanya, ada di halaman <a href="/satgas/filosofi">Filosofi</a>.</p>' },
    { cat: 'Umum', q: 'Di mana saya bisa membaca SK dan pedoman Satgas?',
      a: '<p>Halaman <a href="/satgas/dokumen">Dokumen</a> memuat SK-Pedoman Kekerasan Seks UDINUS 2019 dan SK Satgas PPK UDINUS 2026-2028. Keduanya bisa diunduh.</p>' },

    { cat: 'Melapor', q: 'Bagaimana cara melapor?',
      a: '<p>Klik tombol <b>Laporkan</b> di bagian atas halaman. Anda akan dipandu menjawab pertanyaan satu per satu tentang identitas, pelapor, terlapor, dan peristiwa. Sebelum laporan dikirim, Anda bisa memeriksa dan mengubah jawaban.</p>' },
    { cat: 'Melapor', q: 'Apa saja yang perlu saya siapkan?',
      a: '<p>Siapkan hal berikut sebelum mulai:</p><ul><li>Foto atau pindaian KTP atau KTM</li><li>Data terlapor, jika Anda tahu</li><li>Tanggal, lokasi, dan kronologi peristiwa</li><li>Bukti tindakan atau lokasi kejadian dalam format jpg, jpeg, png, atau pdf</li></ul>' },
    { cat: 'Melapor', q: 'Apakah laporan saya dijaga kerahasiaannya?',
      a: '<p>Segala informasi yang disampaikan dijamin kerahasiaannya.</p>' },
    { cat: 'Melapor', q: 'Bagaimana jika saya tidak tahu data terlapor?',
      a: '<p>Anda boleh melewati pertanyaan nama dan nomor HP terlapor dengan memilih “Tidak tahu”. Ceritakan sebanyak yang Anda ingat pada bagian kronologi.</p>' },
    { cat: 'Melapor', q: 'Apa saja yang bisa dilaporkan?',
      a: '<p>Formulir laporan menyediakan kategori kekerasan seksual, kekerasan fisik, kekerasan psikis, perundungan, diskriminasi dan intoleransi, serta lainnya.</p>' },
    { cat: 'Melapor', q: 'Apa yang terjadi setelah laporan dikirim?',
      a: '<p class="todo">[Jelaskan tahapan penanganan laporan dan perkiraan waktunya.]</p>' },

    { cat: 'Bantuan', q: 'Bagaimana menghubungi Satgas secara langsung?',
      a: '<p>Hubungi <a href="tel:+628888901090">+62 888-890-1090</a> atau datang ke Jl. Nakula I no 5-11 Semarang.</p>' },
    { cat: 'Bantuan', q: 'Bagaimana jika saya sedang dalam bahaya?',
      a: '<p>Hubungi layanan darurat <a href="tel:112">112</a> lebih dulu. Setelah Anda aman, Anda bisa menyampaikan laporan ke Satgas PPK.</p>' }
  ];

  var list = $('#faq-list'), chips = $('#faq-chips'), search = $('#faq-search'), empty = $('#faq-empty'), count = $('#faq-count');
  var cat = 'Semua';

  list.innerHTML = FAQ.map(function (f, i) {
    return '<div class="faq__item' + (i === 0 ? ' is-open' : '') + '" data-cat="' + esc(f.cat) + '">' +
      '<h2 style="margin:0"><button class="faq__q" type="button" id="faq-q' + i + '" aria-expanded="' + (i === 0) + '" aria-controls="faq-a' + i + '">' + esc(f.q) + '</button></h2>' +
      '<div class="faq__a" id="faq-a' + i + '" role="region" aria-labelledby="faq-q' + i + '"' + (i === 0 ? '' : ' inert') + '><div>' + f.a + '</div></div></div>';
  }).join('');

  var cats = ['Semua'];
  FAQ.forEach(function (f) { if (cats.indexOf(f.cat) < 0) cats.push(f.cat); });
  chips.innerHTML = cats.map(function (c, i) { return '<button class="chip" type="button" aria-pressed="' + (i === 0) + '" data-cat="' + esc(c) + '">' + esc(c) + '</button>'; }).join('');

  function apply() {
    var q = search.value.trim().toLowerCase(), shown = 0;
    $$('.faq__item', list).forEach(function (it) {
      var on = (cat === 'Semua' || it.getAttribute('data-cat') === cat) && (!q || it.textContent.toLowerCase().indexOf(q) > -1);
      it.hidden = !on; if (on) shown++;
    });
    empty.hidden = shown > 0;
    count.textContent = shown + ' pertanyaan';
  }
  chips.addEventListener('click', function (e) {
    var b = e.target.closest('.chip'); if (!b) return;
    cat = b.getAttribute('data-cat');
    $$('.chip', chips).forEach(function (x) { x.setAttribute('aria-pressed', String(x === b)); });
    apply();
  });
  search.addEventListener('input', apply);
  list.addEventListener('click', function (e) {
    var b = e.target.closest('.faq__q'); if (!b) return;
    var it = b.closest('.faq__item'), open = !it.classList.contains('is-open');
    it.classList.toggle('is-open', open);
    b.setAttribute('aria-expanded', String(open));
    var a = $('.faq__a', it); a.inert = !open;
  });
  apply();
})();
</script>
@endsection