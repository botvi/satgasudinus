@extends('template-web.layout')
@section('title', 'Lapor — Satgas PPK UDINUS')
@section('content')
<div data-view="lapor">
  <header class="phead">
    <div class="wrap phead__in">
      <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li aria-current="page">Lapor</li></ol></nav>
      <h1>Lapor</h1>
      <p>Sampaikan laporan lewat percakapan terpandu. Anda cukup menjawab satu pertanyaan dalam satu waktu.</p>
    </div>
  </header>
  <div class="page-body">
    <div class="wrap lapor-page">
      <nav class="lp-steps" aria-label="Bagian laporan"><ol id="lp-steps"></ol></nav>

      <section class="chat" id="chat-form" action="{{ route('web.store') }}" data-csrf="{{ csrf_token() }}" aria-label="Percakapan pelaporan">
        <header class="chat__head">
          <span class="logo-img chat__av" role="img" aria-label="Logo Satgas PPKS UDINUS"></span>
          <div>
            <h2>Asisten pelaporan</h2>
            <p id="chat-prog">0 dari 17 pertanyaan dijawab</p>
          </div>
          <button class="chat__reset" type="button" id="chat-reset">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 4v6h6M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
            <span>Mulai ulang</span>
          </button>
        </header>
        <div class="chat__bar" id="chat-bar" role="progressbar" aria-label="Kemajuan pengisian laporan" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><i></i></div>
        <div class="chat__log" id="chat-log" role="log" aria-live="polite" aria-relevant="additions"></div>
        <div class="dock" id="chat-dock"></div>
      </section>

      <aside class="lp-info" aria-label="Informasi pelaporan">
        <section class="lp-card lp-card--calm">
          <h2>Kerahasiaan</h2>
          <p>Segala informasi yang disampaikan dijamin kerahasiaannya.</p>
        </section>
        <section class="lp-card">
          <h2>Siapkan sebelum mulai</h2>
          <ul>
            <li>Foto atau pindaian KTP atau KTM</li>
            <li>Data terlapor, jika Anda tahu</li>
            <li>Tanggal, lokasi, dan kronologi</li>
            <li>Bukti dalam jpg, jpeg, png, atau pdf</li>
          </ul>
        </section>
        <section class="lp-card">
          <h2>Butuh bantuan langsung?</h2>
          <p>Hubungi Satgas PPK di <a href="tel:+628888901090">+62 888-890-1090</a>. Jika Anda dalam bahaya sekarang, hubungi <a href="tel:112">112</a>.</p>
        </section>
      </aside>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('web/lapor.js') }}"></script>
@endsection