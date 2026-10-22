@extends('template-web.layout')
@section('title', 'FAQ — Satgas PPK UDINUS')
@section('content')
<div data-view="faq">
  <header class="phead">
    <div class="wrap phead__in">
      <nav aria-label="Jejak halaman"><ol class="crumbs"><li><a href="/">Beranda</a></li><li aria-current="page">FAQ</li></ol></nav>
      <h1>FAQ</h1>
      <p>Jawaban atas pertanyaan yang sering diajukan seputar pencegahan dan penanganan kekerasan di lingkungan UDINUS. Materi ini mengacu pada Permendikbudristek Nomor 55 Tahun 2024 dan FAQ resmi SAHABAT Kemdiktisaintek.</p>
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
        <nav class="faq__pages" id="faq-pages" aria-label="Halaman pertanyaan" hidden></nav>
      </div>
      <aside class="faq__help" aria-label="Bantuan lain">
        <section class="lp-card lp-card--calm">
          <h2>Belum menemukan jawabannya?</h2>
          <p>Hubungi Satgas PPK di <a href="tel:+628888901090">+62 888-890-1090</a></p>
          <p>Datang ke Jl. Nakula I no 5-11 Semarang</p>
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

  var FAQ = [
    { cat: 'Pengertian', q: 'Apa yang dimaksud dengan kekerasan di lingkungan UDINUS?',
      a: '<p>Kekerasan adalah tindakan atau perilaku yang melanggar hak, keselamatan, martabat, atau integritas seseorang, baik secara fisik, psikis, seksual, maupun dalam bentuk lain yang diatur dalam ketentuan yang berlaku. Kekerasan dapat terjadi secara langsung, melalui komunikasi digital, maupun melalui penyalahgunaan kekuasaan atau relasi yang tidak setara.</p>' },
    { cat: 'Pengertian', q: 'Siapa saja yang dapat mengalami atau melakukan kekerasan di lingkungan UDINUS?',
      a: '<p>Kekerasan dapat melibatkan mahasiswa, dosen, tenaga kependidikan, pimpinan, tenaga pendukung, maupun pihak lain yang berinteraksi dalam kegiatan akademik dan nonakademik. Penanganan mengikuti kewenangan, status para pihak, lokasi kejadian, dan peraturan yang berlaku.</p>' },
    { cat: 'Pengertian', q: 'Apa saja bentuk kekerasan yang perlu dikenali?',
      a: '<ul><li><b>Kekerasan fisik:</b> memukul, menendang, mendorong, atau tindakan fisik yang membahayakan.</li><li><b>Kekerasan psikis:</b> mengancam, mempermalukan, mengintimidasi, atau merendahkan secara berulang maupun melalui tindakan serius yang berdampak pada kondisi psikologis.</li><li><b>Kekerasan seksual:</b> tindakan seksual yang tidak dikehendaki atau bentuk lain yang memenuhi unsur kekerasan seksual menurut ketentuan hukum.</li><li><b>Perundungan (bullying):</b> perilaku agresif atau merendahkan yang dapat melibatkan ketimpangan kekuatan dan berulang.</li><li><b>Kekerasan digital:</b> ancaman, pelecehan, penyebaran konten pribadi tanpa hak, atau intimidasi melalui media elektronik.</li><li><b>Diskriminasi dan penyalahgunaan relasi kuasa:</b> perlakuan merugikan atau tekanan yang berkaitan dengan posisi, kewenangan, atau ketidaksetaraan relasi, sesuai unsur yang diatur dalam ketentuan terkait.</li></ul><p>Suatu kejadian perlu dinilai berdasarkan fakta, konteks, dampak, dan ketentuan yang berlaku; tidak semua konflik atau ketidaknyamanan otomatis merupakan pelanggaran yang sama.</p>' },
    { cat: 'Pengertian', q: 'Apakah kekerasan hanya terjadi di dalam kampus?',
      a: '<p>Tidak. Kejadian dapat berlangsung di ruang kelas, laboratorium, tempat magang, kegiatan organisasi, kegiatan resmi kampus, maupun ruang digital. Kejadian di luar kampus juga dapat relevan apabila berkaitan dengan sivitas akademika atau kegiatan perguruan tinggi dan termasuk dalam kewenangan penanganan UDINUS.</p>' },
    { cat: 'Pengertian', q: 'Apakah candaan, senioritas, atau alasan kedisiplinan dapat membenarkan kekerasan?',
      a: '<p>Tidak. Candaan, tradisi senioritas, kedisiplinan, maupun alasan pembinaan tidak membenarkan ancaman, penghinaan, pemaksaan, pelecehan, atau tindakan yang melanggar ketentuan. Penilaian tetap mempertimbangkan konteks dan bukti yang tersedia.</p>' },

    { cat: 'Pelaporan', q: 'Siapa yang boleh melaporkan dugaan kekerasan?',
      a: '<p>Korban, saksi, atau pihak lain yang mengetahui atau memiliki informasi mengenai dugaan kekerasan dapat menyampaikan laporan melalui kanal yang tersedia. Korban tidak harus melaporkan sendiri apabila belum siap atau membutuhkan pendampingan.</p>' },
    { cat: 'Pelaporan', q: 'Ke mana laporan dugaan kekerasan di UDINUS disampaikan?',
      a: '<p>Laporan dapat disampaikan melalui kanal resmi PPK UDINUS di <a href="https://ppk.dinus.ac.id/">ppk.dinus.ac.id</a>. Pelapor sebaiknya menggunakan kanal resmi dan mengikuti petunjuk yang tersedia. Jika terdapat bahaya langsung, utamakan keselamatan dan hubungi layanan darurat atau pihak berwenang yang sesuai.</p>' },
    { cat: 'Pelaporan', q: 'Informasi apa yang sebaiknya dicatat dalam laporan?',
      a: '<p>Informasi awal yang dapat membantu penanganan meliputi:</p><ul><li><b>Waktu dan tempat:</b> tanggal, perkiraan waktu, dan lokasi kejadian.</li><li><b>Bentuk kejadian:</b> uraian tindakan atau perilaku yang dilaporkan.</li><li><b>Pihak terkait:</b> identitas korban, saksi, dan pihak terlapor sejauh diketahui.</li><li><b>Kronologi:</b> urutan kejadian berdasarkan informasi yang tersedia.</li><li><b>Bukti pendukung:</b> pesan, tangkapan layar, foto, dokumen, atau informasi relevan lainnya.</li><li><b>Kontak pelapor:</b> cara menghubungi pelapor secara aman, apabila tersedia.</li></ul><p>Pelapor tidak harus memiliki seluruh bukti atau dapat menjawab semua pertanyaan sejak awal untuk meminta bantuan. Hindari mengumpulkan bukti dengan cara yang membahayakan diri sendiri atau orang lain.</p>' },
    { cat: 'Pelaporan', q: 'Apakah laporan harus disertai bukti lengkap?',
      a: '<p>Tidak. Informasi awal yang tersedia dapat disampaikan terlebih dahulu. Penelusuran dan pemeriksaan lebih lanjut dilakukan oleh pihak yang berwenang melalui prosedur yang berlaku. Ketiadaan bukti lengkap pada saat pelaporan tidak boleh dijadikan alasan untuk menolak mendengarkan kebutuhan keselamatan korban.</p>' },
    { cat: 'Pelaporan', q: 'Apakah laporan dapat disampaikan oleh saksi atau teman korban?',
      a: '<p>Ya. Saksi atau teman korban dapat membantu menyampaikan informasi, mendampingi korban, atau menghubungkannya dengan PPK UDINUS. Informasi yang disampaikan perlu dibedakan antara hal yang dilihat atau didengar secara langsung dan hal yang diketahui dari cerita orang lain.</p>' },
    { cat: 'Pelaporan', q: 'Apakah laporan dapat dirahasiakan?',
      a: '<p>Identitas, kronologi, bukti, dan informasi pribadi harus dilindungi serta hanya diakses oleh pihak yang berwenang sesuai kebutuhan penanganan. Namun, kerahasiaan tidak selalu berarti anonimitas mutlak karena informasi tertentu mungkin diperlukan untuk pemeriksaan, perlindungan, atau kewajiban hukum. Batas kerahasiaan sebaiknya dijelaskan kepada pelapor sejak awal.</p>' },
    { cat: 'Pelaporan', q: 'Apakah korban boleh melapor tanpa langsung berhadapan dengan pihak terlapor?',
      a: '<p>Korban dapat meminta agar komunikasi dan proses penanganan dilakukan dengan cara yang aman serta meminimalkan kontak yang tidak diperlukan. Pertemuan langsung atau mediasi tidak boleh dipaksakan, terutama jika berisiko menimbulkan tekanan, intimidasi, atau trauma tambahan.</p>' },
    { cat: 'Pelaporan', q: 'Apakah laporan akan dicatat dan dipantau perkembangannya?',
      a: '<p>Laporan perlu didokumentasikan secara tertib oleh petugas yang berwenang, termasuk tanggal penerimaan, informasi awal, langkah tindak lanjut, rujukan layanan, dan status penanganan. Informasi perkembangan disampaikan kepada pihak yang berhak sesuai prosedur dan ketentuan kerahasiaan yang berlaku.</p>' },
    { cat: 'Pelaporan', q: 'Apakah laporan dapat dicabut atau dihentikan?',
      a: '<p>Pelapor dapat menyampaikan perubahan informasi atau keinginannya untuk tidak melanjutkan keterlibatan. Namun, penghentian penanganan tidak selalu otomatis karena pihak berwenang perlu mempertimbangkan keselamatan, risiko terhadap pihak lain, ketentuan yang berlaku, serta kewajiban institusi. Pelapor perlu memperoleh penjelasan mengenai konsekuensi dan pilihan yang tersedia.</p>' },

    { cat: 'Perlindungan', q: 'Apa yang harus dilakukan jika seseorang mengungkapkan bahwa dirinya mengalami kekerasan?',
      a: '<p>Gunakan pendekatan Recognize → Listen → Support → Refer → Report.</p><ul><li><b>Recognize — Kenali.</b> Peka terhadap tanda bahaya, perubahan perilaku, atau pengungkapan dugaan kekerasan.</li><li><b>Listen — Dengarkan.</b> Dengarkan tanpa menghakimi, menyalahkan, menyela, atau memaksa korban menceritakan detail yang belum siap disampaikan.</li><li><b>Support — Dukung.</b> Tanyakan kebutuhan dan keselamatan korban. Jangan menjanjikan kerahasiaan mutlak yang tidak dapat dijamin.</li><li><b>Refer — Rujuk.</b> Hubungkan korban dengan PPK UDINUS dan layanan kesehatan, psikologis, pendampingan, atau bantuan hukum sesuai kebutuhan.</li><li><b>Report — Laporkan.</b> Bantu korban mengakses kanal pelaporan yang sesuai dengan persetujuan dan kebutuhan keselamatannya, dengan memperhatikan kewajiban hukum yang berlaku.</li></ul>' },
    { cat: 'Perlindungan', q: 'Apa yang tidak boleh dilakukan saat menerima pengaduan?',
      a: '<ul><li>Menyalahkan korban atau mempertanyakan mengapa korban tidak segera melapor.</li><li>Memaksa korban menceritakan ulang kejadian kepada banyak orang.</li><li>Menyebarkan identitas, kronologi, atau bukti melalui grup percakapan dan media sosial.</li><li>Menghubungi atau menghadapkan korban dengan terlapor tanpa mempertimbangkan risiko dan prosedur.</li><li>Melakukan investigasi sendiri, menginterogasi saksi, atau menyimpulkan siapa yang bersalah sebelum pemeriksaan.</li><li>Menjanjikan hasil atau sanksi tertentu sebelum proses selesai.</li></ul>' },
    { cat: 'Perlindungan', q: 'Bentuk perlindungan apa yang dapat dibutuhkan korban?',
      a: '<p>Perlindungan ditentukan berdasarkan kebutuhan dan penilaian risiko, antara lain:</p><ul><li>Perlindungan dari ancaman, intimidasi, dan pembalasan.</li><li>Pendampingan selama proses pelaporan dan penanganan.</li><li>Akses terhadap layanan kesehatan dan dukungan psikologis.</li><li>Pengaturan kegiatan akademik atau pekerjaan yang diperlukan untuk keselamatan.</li><li>Rujukan ke layanan hukum atau layanan eksternal yang kompeten.</li><li>Dukungan pemulihan dan pemantauan sesuai kebutuhan.</li></ul><p>Pelaksanaan bentuk perlindungan tertentu perlu disesuaikan dengan kewenangan institusi, persetujuan pihak terkait, dan ketentuan yang berlaku.</p>' },
    { cat: 'Perlindungan', q: 'Apakah korban dapat memperoleh pendampingan psikologis dan medis?',
      a: '<p>Ya. Korban dapat dibantu mengakses layanan kesehatan, psikologis, dan dukungan pemulihan sesuai kebutuhannya. Jika terdapat cedera, ancaman serius, atau keadaan darurat, pertolongan medis dan keselamatan harus diprioritaskan tanpa menunggu proses administratif.</p>' },
    { cat: 'Perlindungan', q: 'Bagaimana jika korban takut mengalami pembalasan atau dampak akademik dan pekerjaan?',
      a: '<p>Korban dapat menyampaikan kekhawatiran tersebut kepada PPK UDINUS agar risiko dapat dinilai dan langkah perlindungan dipertimbangkan. Ancaman, intimidasi, atau tindakan merugikan sebagai pembalasan atas pelaporan perlu didokumentasikan dan dilaporkan kembali. Perlindungan harus diupayakan tanpa mengurangi hak pihak lain untuk memperoleh proses yang adil.</p>' },
    { cat: 'Perlindungan', q: 'Apakah korban harus menceritakan kejadian secara detail sejak awal?',
      a: '<p>Tidak. Korban dapat menyampaikan informasi sesuai kesiapan dan kebutuhan penanganan. Petugas sebaiknya mengajukan pertanyaan yang relevan, proporsional, dan tidak menyudutkan. Pemeriksaan lanjutan dilakukan oleh pihak yang berwenang dengan pendekatan yang menghormati martabat dan kondisi korban.</p>' },

    { cat: 'Terlapor', q: 'Apa perbedaan terlapor dan pelaku?',
      a: '<p><b>Terlapor</b> adalah pihak yang dilaporkan atau diduga melakukan kekerasan dan belum tentu terbukti melakukan pelanggaran.</p><p><b>Pelaku</b> adalah istilah yang digunakan sesuai konteks dan hasil proses penanganan atau penetapan oleh pihak yang berwenang.</p><p>Dalam komunikasi resmi, gunakan istilah terlapor selama dugaan masih diperiksa. Hal ini penting untuk menjaga asas praduga tidak bersalah dan proses yang adil.</p>' },
    { cat: 'Terlapor', q: 'Apa yang terjadi setelah seseorang dilaporkan melakukan kekerasan?',
      a: '<p>Laporan ditelaah dan ditindaklanjuti sesuai mekanisme yang berlaku. Secara umum, proses dapat meliputi:</p><ul><li>Penerimaan dan pencatatan laporan.</li><li>Penilaian kebutuhan keselamatan serta perlindungan.</li><li>Pemeriksaan informasi dan pengumpulan keterangan oleh pihak berwenang.</li><li>Pemberian kesempatan kepada para pihak untuk menyampaikan keterangan sesuai prosedur.</li><li>Penentuan tindak lanjut berdasarkan hasil pemeriksaan dan kewenangan institusi.</li><li>Pemberian rekomendasi, tindakan administratif atau disiplin apabila memenuhi ketentuan, serta pemantauan dan pemulihan yang diperlukan.</li></ul><p>Tahapan dan kewenangan harus mengikuti peraturan yang berlaku serta SOP resmi UDINUS. Penerimaan laporan bukan berarti seseorang otomatis dinyatakan bersalah.</p>' },
    { cat: 'Terlapor', q: 'Apakah terlapor memiliki hak selama proses penanganan?',
      a: '<p>Ya. Terlapor berhak memperoleh proses yang adil, mengetahui dugaan yang ditujukan kepadanya sesuai tahapan dan ketentuan yang berlaku, memberikan keterangan, menyampaikan informasi atau bukti yang relevan, serta mendapatkan perlindungan atas informasi pribadi sesuai aturan. Hak tersebut tidak menghilangkan kewajiban institusi untuk melindungi korban dan saksi.</p>' },
    { cat: 'Terlapor', q: 'Apakah terlapor dapat diminta menjaga jarak dari korban selama pemeriksaan?',
      a: '<p>Langkah sementara dapat dipertimbangkan berdasarkan penilaian risiko, kebutuhan keselamatan, dan kewenangan institusi. Pengaturan tersebut bukan dengan sendirinya merupakan penetapan kesalahan. Pelaksanaannya perlu proporsional, terdokumentasi, dan tidak digunakan untuk menghukum seseorang sebelum proses selesai.</p>' },
    { cat: 'Terlapor', q: 'Apakah terlapor dapat dikenai sanksi?',
      a: '<p>Ya, apabila hasil pemeriksaan menunjukkan adanya pelanggaran dan sanksi tersebut memiliki dasar yang sesuai. Bentuk tindakan bergantung pada jenis pelanggaran, status pihak yang bersangkutan, peraturan institusi, dan ketentuan hukum yang berlaku. Sanksi tidak ditentukan hanya berdasarkan rumor, tekanan publik, atau unggahan di media sosial.</p>' },
    { cat: 'Terlapor', q: 'Apakah pelaku juga dapat memperoleh pembinaan atau layanan pemulihan?',
      a: '<p>Dapat, sesuai hasil penanganan dan ketentuan yang berlaku. Pembinaan, konseling, atau program perubahan perilaku dapat dipertimbangkan apabila relevan. Namun, layanan tersebut tidak menggantikan pertanggungjawaban atas pelanggaran dan tidak boleh memaksa korban bertemu, memaafkan, berdamai, atau mencabut laporan.</p>' },
    { cat: 'Terlapor', q: 'Apakah masalah kekerasan dapat diselesaikan secara kekeluargaan?',
      a: '<p>Penyelesaian secara informal tidak boleh digunakan untuk menekan korban, menutupi dugaan pelanggaran, atau menghindari proses yang diwajibkan. Setiap opsi penyelesaian harus dinilai berdasarkan jenis kejadian, risiko, hak para pihak, dan peraturan yang berlaku. Mediasi atau pertemuan langsung tidak boleh dipaksakan ketika berpotensi membahayakan atau menimbulkan tekanan terhadap korban.</p>' },
    { cat: 'Terlapor', q: 'Apakah kasus kekerasan hanya ditangani oleh UDINUS?',
      a: '<p>Tidak selalu. Apabila terdapat dugaan tindak pidana atau kebutuhan layanan di luar kewenangan kampus, penanganan dapat memerlukan koordinasi atau rujukan kepada aparat penegak hukum, fasilitas kesehatan, layanan perlindungan, atau lembaga berwenang lainnya. Proses internal kampus dan proses hukum memiliki kewenangan masing-masing.</p>' },

    { cat: 'Pencatatan', q: 'Bagaimana UDINUS sebaiknya melakukan pencatatan kasus kekerasan?',
      a: '<p>Pencatatan perlu menggunakan sistem yang tertib, terbatas aksesnya, dan dapat ditelusuri oleh petugas yang berwenang.</p><ul><li><b>Nomor atau kode kasus:</b> menggunakan identitas kasus yang unik jika tersedia.</li><li><b>Identitas para pihak:</b> disimpan secara terbatas dan dilindungi.</li><li><b>Kronologi:</b> dicatat secara faktual, kronologis, dan tidak menghakimi.</li><li><b>Bukti dan keterangan:</b> disimpan aman dengan akses terkendali.</li><li><b>Penilaian risiko:</b> mencatat kebutuhan perlindungan dan tindakan segera.</li><li><b>Tindak lanjut:</b> mencatat tanggal, petugas, tindakan, dan rujukan.</li><li><b>Status kasus:</b> membedakan laporan diterima, pemeriksaan, tindak lanjut, dan penyelesaian.</li><li><b>Pemulihan:</b> mencatat layanan yang diperlukan dan tindak lanjut sesuai kewenangan.</li></ul><p>Data untuk pelaporan institusi, monitoring, dan evaluasi sebaiknya menggunakan data agregat atau data yang telah dianonimkan apabila identitas tidak diperlukan. Informasi sensitif tidak boleh dipublikasikan dalam dashboard atau laporan terbuka.</p>' },
    { cat: 'Pencatatan', q: 'Siapa yang boleh mengakses data kasus?',
      a: '<p>Akses diberikan kepada petugas atau pihak yang berwenang berdasarkan tugas dan kebutuhan penanganan. Dosen, pimpinan program studi, atasan, atau pengelola unit tidak otomatis berhak mengakses seluruh detail kasus hanya karena memiliki jabatan. Informasi yang dibagikan harus proporsional dan sesuai ketentuan kerahasiaan.</p>' },
    { cat: 'Pencatatan', q: 'Apakah pimpinan program studi atau atasan harus menangani laporan sendiri?',
      a: '<p>Tidak harus. Pimpinan program studi atau atasan dapat menerima informasi awal, membantu memastikan keselamatan, dan mengarahkan pelapor ke PPK UDINUS. Pemeriksaan kasus sebaiknya dilakukan oleh pihak yang berwenang sesuai mekanisme resmi, terutama untuk mencegah konflik kepentingan, keberpihakan, dan pemeriksaan berulang yang tidak diperlukan.</p>' },
    { cat: 'Pencatatan', q: 'Bagaimana jika laporan melibatkan pimpinan, dosen, atau pejabat yang memiliki kewenangan?',
      a: '<p>Laporan perlu diarahkan melalui mekanisme yang menjamin independensi dan menghindari konflik kepentingan. Pihak yang memiliki hubungan langsung dengan kasus tidak seharusnya mengendalikan pemeriksaan yang menyangkut dirinya. Penentuan petugas atau jalur alternatif harus mengikuti ketentuan dan kewenangan yang berlaku.</p>' },
    { cat: 'Pencatatan', q: 'Bagaimana jika laporan tidak terbukti?',
      a: '<p>Tidak terbuktinya suatu dugaan tidak dengan sendirinya berarti pelapor sengaja memberikan laporan palsu. Penanganan perlu didasarkan pada informasi dan bukti yang tersedia, dengan memperhatikan keterbatasan pemeriksaan. Tuduhan yang terbukti sengaja dibuat secara tidak benar ditangani secara terpisah berdasarkan ketentuan yang berlaku, bukan berdasarkan asumsi.</p>' },
    { cat: 'Pencatatan', q: 'Apakah kasus yang sudah ditangani masih perlu dipantau?',
      a: '<p>Ya, apabila diperlukan. Pemantauan dapat mencakup keselamatan korban, risiko intimidasi atau pembalasan, akses terhadap layanan pemulihan, dan pelaksanaan tindak lanjut yang telah ditetapkan. Informasi pemantauan disimpan secara aman dan tidak disebarluaskan kepada pihak yang tidak berwenang.</p>' },

    { cat: 'Praktis', q: 'Apa yang harus dilakukan jika menyaksikan kekerasan secara langsung?',
      a: '<p>Utamakan keselamatan. Jika aman, bantu menghentikan situasi tanpa memperbesar risiko, cari bantuan petugas yang berwenang, dan dukung orang yang terdampak. Catat informasi yang diketahui secara faktual dan sampaikan melalui kanal resmi. Jangan mengambil risiko fisik yang tidak dapat dikendalikan.</p>' },
    { cat: 'Praktis', q: 'Apa yang harus dilakukan jika menemukan unggahan dugaan kekerasan di media sosial?',
      a: '<p>Jangan langsung menyebarkan ulang unggahan, identitas, foto, atau bukti yang dapat membuka identitas korban. Simpan informasi yang relevan secara aman apabila diperlukan, kemudian arahkan informasi tersebut kepada PPK UDINUS atau pihak berwenang. Unggahan di media sosial tidak menggantikan proses pemeriksaan resmi.</p>' },
    { cat: 'Praktis', q: 'Bagaimana jika kejadian berlangsung saat magang, KKN, penelitian, atau kegiatan di luar kampus?',
      a: '<p>Korban atau saksi dapat meminta bantuan melalui kanal PPK UDINUS. Penanganan dapat memerlukan koordinasi dengan institusi mitra, tempat magang, fasilitas kesehatan, atau pihak berwenang sesuai konteks kejadian. Koordinasi harus memperhatikan keselamatan dan kerahasiaan informasi.</p>' },
    { cat: 'Praktis', q: 'Apakah mahasiswa yang melaporkan kekerasan akan kehilangan hak akademiknya?',
      a: '<p>Pelaporan tidak boleh menjadi alasan untuk mengintimidasi atau melakukan pembalasan terhadap pelapor. Apabila muncul ancaman terhadap hak akademik, korban dapat menyampaikannya kepada PPK UDINUS agar risiko dan kebutuhan perlindungan ditindaklanjuti sesuai kewenangan.</p>' },
    { cat: 'Praktis', q: 'Apa yang harus dilakukan jika seseorang membutuhkan bantuan segera?',
      a: '<p>Jika terdapat ancaman fisik, cedera serius, atau risiko keselamatan yang mendesak, segera cari tempat aman dan hubungi layanan darurat atau aparat berwenang yang sesuai. Untuk dukungan lanjutan dan pelaporan di lingkungan kampus, hubungi PPK UDINUS melalui kanal resminya.</p>' },
    { cat: 'Praktis', q: 'Di mana memperoleh informasi resmi tentang pencegahan dan penanganan kekerasan di UDINUS?',
      a: '<p>Informasi dan kanal pelaporan PPK UDINUS dapat diakses melalui <a href="https://ppk.dinus.ac.id/">ppk.dinus.ac.id</a>.</p>' }
  ];

  var list = $('#faq-list'), chips = $('#faq-chips'), search = $('#faq-search'), empty = $('#faq-empty'), count = $('#faq-count'), pager = $('#faq-pages');
  var cat = 'Semua', page = 1, PER = 8;

  list.innerHTML = FAQ.map(function (f, i) {
    return '<div class="faq__item' + (i === 0 ? ' is-open' : '') + '" data-cat="' + esc(f.cat) + '">' +
      '<h2 style="margin:0"><button class="faq__q" type="button" id="faq-q' + i + '" aria-expanded="' + (i === 0) + '" aria-controls="faq-a' + i + '">' + esc(f.q) + '</button></h2>' +
      '<div class="faq__a" id="faq-a' + i + '" role="region" aria-labelledby="faq-q' + i + '"' + (i === 0 ? '' : ' inert') + '><div>' + f.a + '</div></div></div>';
  }).join('');

  var cats = ['Semua'];
  FAQ.forEach(function (f) { if (cats.indexOf(f.cat) < 0) cats.push(f.cat); });
  chips.innerHTML = cats.map(function (c, i) { return '<button class="chip" type="button" aria-pressed="' + (i === 0) + '" data-cat="' + esc(c) + '">' + esc(c) + '</button>'; }).join('');

  function apply(fromPager) {
    var q = search.value.trim().toLowerCase(), matched = [];
    $$('.faq__item', list).forEach(function (it) {
      var on = (cat === 'Semua' || it.getAttribute('data-cat') === cat) && (!q || it.textContent.toLowerCase().indexOf(q) > -1);
      it.hidden = true;
      if (on) matched.push(it);
    });
    var pagesN = Math.max(1, Math.ceil(matched.length / PER));
    if (page > pagesN) page = pagesN;
    var start = (page - 1) * PER, end = Math.min(start + PER, matched.length);
    for (var i = start; i < end; i++) matched[i].hidden = false;
    empty.hidden = matched.length > 0;
    count.textContent = !matched.length ? '0 pertanyaan' : (pagesN > 1 ? (start + 1) + '–' + end + ' dari ' + matched.length + ' pertanyaan' : matched.length + ' pertanyaan');
    var nav = '';
    if (pagesN > 1) {
      nav = '<button type="button" data-go="prev"' + (page === 1 ? ' disabled' : '') + '>Sebelumnya</button>';
      for (var n = 1; n <= pagesN; n++) nav += '<button type="button" data-go="' + n + '"' + (n === page ? ' aria-current="page"' : '') + ' aria-label="Halaman ' + n + '">' + n + '</button>';
      nav += '<button type="button" data-go="next"' + (page === pagesN ? ' disabled' : '') + '>Berikutnya</button>';
    }
    pager.hidden = pagesN < 2;
    pager.innerHTML = nav;
    if (fromPager) {
      list.scrollIntoView({ behavior: 'smooth', block: 'start' });
      var cur = $('[aria-current="page"]', pager);
      if (cur) cur.focus();
    }
  }
  chips.addEventListener('click', function (e) {
    var b = e.target.closest('.chip'); if (!b) return;
    cat = b.getAttribute('data-cat');
    page = 1;
    $$('.chip', chips).forEach(function (x) { x.setAttribute('aria-pressed', String(x === b)); });
    apply(false);
  });
  search.addEventListener('input', function () { page = 1; apply(false); });
  pager.addEventListener('click', function (e) {
    var b = e.target.closest('button'); if (!b || b.disabled) return;
    var go = b.getAttribute('data-go');
    page = go === 'prev' ? page - 1 : go === 'next' ? page + 1 : +go;
    apply(true);
  });
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