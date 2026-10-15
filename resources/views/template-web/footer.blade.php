<!-- ================= FOOTER ================= -->
<footer class="footer">
  <div class="wrap footer__grid">
    <div class="footer__brand">
      <h2 class="footer__name">Satgas PPK</h2>
      <p>Portal Website Satuan Tugas PPK Universitas Dian Nuswantoro</p>
      <div class="contact">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span>{{ \App\Models\Setting::value('alamat', 'Jl. Nakula I no 5-11 Semarang') }}</span>
      </div>
      <div class="contact">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        @php $tel = \App\Models\Setting::value('telepon', '+62 888-890-1090'); @endphp
        <a href="tel:{{ preg_replace('/[^+\d]/', '', $tel) }}" style="text-decoration:none">{{ $tel }}</a>
      </div>
    </div>

    <nav aria-label="Telusuri">
      <h2>Telusuri</h2>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/satgas/kegiatan">Kegiatan</a></li>
        <li><a href="/satgas/dokumen">Dokumen</a></li>
        <li><a href="/satgas/pengantar">Pengantar</a></li>
        <li><a href="/satgas/faq">FAQ</a></li>
      </ul>
    </nav>

    <nav aria-label="Tautan">
      <h2>Tautan</h2>
      <ul>
        <li><a href="/satgas/galeri">Galeri</a></li>
        <li><a href="/satgas/filosofi">Filosofi</a></li>
        <li><a href="/satgas/lapor">Laporkan</a></li>
      </ul>
    </nav>

    <div>
      <h2>Media Sosial</h2>
      <div class="social">
        <a href="{{ \App\Models\Setting::value('instagram_url', 'https://www.instagram.com/satgasppks.udinus?igsh=cHYxdm1oamd5MGV1') }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram Satgas PPK">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><path d="M17.5 6.5h.01"/></svg>
        </a>
        <a href="{{ \App\Models\Setting::value('whatsapp_url', 'https://wa.me/+628888901090') }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp Satgas PPK">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/><g transform="translate(7 7) scale(.42)"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke-width="3.4"/></g></svg>
        </a>
      </div>
    </div>
  </div>
  <div class="footer__legal">© {{ date('Y') }} Satgas PPK · Created by <a href="https://firstudio.id" target="_blank" rel="noopener">firstudio.id</a></div>
</footer>