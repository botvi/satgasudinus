@extends('template-web.layout')
@section('title', 'Dokumen — Satgas PPK UDINUS')
@section('content')
<div data-view="dokumen">
  <header class="phead">
    <div class="wrap phead__in">
      <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li aria-current="page">Dokumen</li></ol></nav>
      <h1>Dokumen</h1>
      <p>Dokumen resmi Satgas PPK UDINUS yang dapat diunduh.</p>
    </div>
  </header>
  <div class="page-body">
    <div class="wrap">
      <label class="search">
        <span class="sr">Cari dokumen</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
        <input type="search" id="doc-search" placeholder="Cari dokumen" autocomplete="off">
      </label>
      <div class="dgrid" id="dgrid">
        @foreach ($dokumens as $dokumen)
        <article class="dcard">
          <div class="dicon" aria-hidden="true"><svg viewBox="0 0 92 120">
              <path d="M6 4h56l24 24v88H6z" fill="#fff" stroke="#1E3A8A" stroke-width="3.5" stroke-linejoin="round"/>
              <path d="M62 4v24h24" fill="#D7E3FF" stroke="#1E3A8A" stroke-width="3.5" stroke-linejoin="round"/>
              <path d="M20 46h40M20 58h52M20 70h30" stroke="#C3CEEC" stroke-width="3.5" stroke-linecap="round"/>
              <rect x="0" y="84" width="66" height="26" rx="4" fill="#DC2626"/>
              <text x="33" y="102" text-anchor="middle" font-family="Bricolage Grotesque, Hanken Grotesk, sans-serif" font-weight="800" font-size="16" fill="#fff">PDF</text>
            </svg></div>
          <div>
            <h2>{{ $dokumen->title }}</h2>
            <p>{{ $dokumen->deskripsi }}</p>
            <div class="dcard__foot"><a class="btn btn--solid" href="{{ asset('dokumen/' . $dokumen->file) }}" download><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v12m0 0-4.5-4.5M12 15l4.5-4.5M4 20h16"/></svg> Unduh</a><span>PDF</span></div>
          </div>
        </article>
        @endforeach
      </div>
      <p class="empty" id="doc-empty" @if($dokumens->isNotEmpty()) hidden @endif>Tidak ada dokumen yang cocok. Coba kata kunci lain, misalnya “SK”.</p>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
(function () {
  var $ = function (q, r) { return (r || document).querySelector(q); };
  var $$ = function (q, r) { return Array.prototype.slice.call((r || document).querySelectorAll(q)); };
  var search = $('#doc-search'), emptyD = $('#doc-empty');
  search.addEventListener('input', function () {
    var q = search.value.trim().toLowerCase(), shown = 0;
    $$('.dcard').forEach(function (c) {
      var on = !q || c.textContent.toLowerCase().indexOf(q) > -1;
      c.style.display = on ? '' : 'none'; if (on) shown++;
    });
    emptyD.hidden = shown > 0;
  });

})();
</script>
@endsection