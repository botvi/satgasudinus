@extends('template-web.layout')
@section('title', 'Sekapur Sirih — Satgas PPK UDINUS')
@section('content')
<div data-view="pengantar">
  <header class="phead">
    <div class="wrap phead__in">
      <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li>Profil</li><li aria-current="page">Pengantar</li></ol></nav>
      <h1>Sekapur Sirih</h1>
      <p>Pengantar dari Satgas PPK Universitas Dian Nuswantoro.</p>
    </div>
  </header>
  <div class="page-body">
    <div class="wrap pengantar">
      <figure class="video pengantar__media">
        <div class="video__frame"><img src="{{ asset('env/cover2.jpg') }}" alt="Satgas PPK UDINUS"></div>
      </figure>
      <article class="prose">
        <p>Pusat Pencegahan dan Penanganan Kekerasan (PPK) PT UDINUS merupakan unit resmi universitas yang berkomitmen menciptakan lingkungan kampus yang aman, inklusif, dan bermartabat bagi seluruh sivitas akademika.</p>
        <p>Seiring dengan perkembangan kebijakan nasional, PPK PT UDINUS merupakan penyesuaian dari PPKS PT UDINUS yang sebelumnya berfokus pada pencegahan dan penanganan kekerasan seksual. Saat ini, lingkup kerja PPK PT UDINUS diperluas untuk mencakup berbagai bentuk kekerasan, baik fisik, psikis, seksual, perundungan, diskriminasi, maupun bentuk kekerasan lainnya yang berpotensi terjadi di lingkungan perguruan tinggi.</p>
        <p>PPK PT UDINUS berperan dalam pencegahan, edukasi, pendampingan, pelaporan, serta penanganan kasus kekerasan secara berperspektif korban, berkeadilan, dan menjunjung tinggi kerahasiaan. Melalui kolaborasi lintas unit dan penguatan budaya saling menghormati, PPK PT UDINUS terus berupaya membangun kampus yang aman tanpa kekerasan sebagai fondasi utama proses pendidikan yang berkualitas.</p>
      </article>
    </div>


    <div class="wrap">
      <div class="cta-band">
        <h2>Baca dokumen resmi Satgas PPK UDINUS</h2>
        <div>
          <a class="btn btn--solid btn--lg" href="/satgas/dokumen">Lihat dokumen</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
