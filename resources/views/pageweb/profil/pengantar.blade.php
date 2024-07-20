@extends('template-web.layout')

@section('content')
<div class="mx-auto max-w-6xl p-10 mt-24 my-5">
    <h1 class="text-2xl font-bold mb-8 text-center">Pengantar</h1>
    
    <section
        class="relative bg-cover bg-center h-96"
        style="background-image: url('{{ asset('env') }}/cover2.jpg'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
    </section>

    <section class="p-10">
        <h2 class="text-2xl font-bold mb-4">Sekapur Sirih</h2>
        <p class="text-gray-700 text-justify">
            Mahasiswa berada di rentang usia 18-22 tahun, dimana mereka berada di tahap remaja akhir menuju perkembangan dewasa muda. Santrock (2011) menjelaskan bahwa pada masa ini, mahasiswa berusaha membentuk struktur kehidupannya sendiri dari berbagai sumber informasi dan pengalamannya.
        </p><br>
        <p class="text-gray-700 text-justify">
            Pada masa remaja, seorang anak akan mengalami perkembangan psikologis, seksualitas dan emosionalitas yang mempengaruhi tingkah lakunya, sehingga akan menimbulkan permasalahan bagi dirinya. Salah satunya terkait permasalahan kesehatan reproduksi di usia remaja, yaitu kekerasan seksual.
        </p><br>
        <p class="text-gray-700 text-justify">
            Hasil Survei Nasional Pengalaman Hidup Anak dan Remaja (SNPHAR) tahun 2021 menyebutkan bahwa telah terjadi tindakan kekerasan baik kontak maupun non kontak pada remaja (18-24 tahun). Prevalensi kekerasan seksual pada perempuan dua kali lipat lebih banyak dibandingkan laki-laki, dimana jumlah kasus perempuan sebesar 7,32% sedangkan laki-laki 4,20%. Kasus kekerasan seksual di perkotaan mempunyai prevalensi dua kali (2x) lipat lebih besar dibandingkan di pedesaan.
        </p><br>
        <p class="text-gray-700 text-justify">
            Demikian dengan Survei Kementerian Pendidikan, Kebudayaan, Riset dan Teknologi (Kemendikbudristek), menemukan bahwa kekerasan seksual terbanyak terjadi di perguruan tinggi, per Juli 2023 terdapat 65 kasus kekerasan seksual di perguruan tinggi, dibandingkan di sekolah menengah (22 kasus) dan sekolah dasar (26 kasus).
        </p><br>
        <p class="text-gray-700 text-justify">
            Peraturan Menteri Pendidikan, Kebudayaan, Riset dan Teknologi Republik Indonesia Nomor 30 tahun 2021, tentang Pencegahan dan Penanganan Kekerasan Seksual di Lingkungan Perguruan Tinggi bertujuan menumbuhkan kehidupan kampus yang manusiawi, bermartabat, setara, inklusif, kolaboratif, serta tanpa kekerasan di antara Mahasiswa, Pendidik, Tenaga Kependidikan, dan Warga Kampus di Perguruan Tinggi.
        </p><br>
        <p class="text-gray-700 text-justify">
            Universitas Dian Nuswantoro berkomitmen mendukung kebijakan melalui:
        </p>
        <ol class="list-decimal list-inside text-gray-700 text-justify">
            <li>Surat Keputusan Rektor No.0172/KEP/UDN-01/II/2019 tentang Pedoman Pencegahan dan Penanganan Kekerasan Seksual, Perundungan dan Intimidasi di Lingkungan Universitas Dian Nuswantoro.</li>
            <li>Pembentukan Satuan Tugas Pencegahan dan Penanganan Kekerasan Sekual (Satgas PPKS) Universitas Dian Nuswantoro, mulai tahun 2022.</li>
        </ol>
    </section>
</div>
@endsection
