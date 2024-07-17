@extends('template-web.layout')

@section('content')
<div class="flex justify-center mt-20 p-4 md:p-10 my-5">
  <form action="{{ route('web.store') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-4xl bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
    @csrf
    <!-- Judul Halaman -->
    <h1 class="text-2xl font-bold mb-8 text-center">Form Laporan</h1>

    <!-- Identitas -->
    <div class="mb-8 border rounded-lg p-4 space-y-4 md:flex md:flex-row md:space-y-0 md:space-x-4 md:justify-between">
      <div class="w-full md:w-1/2">
        <h2 class="text-xl font-bold mb-4">Identitas</h2>
        <div>
          <label class="block text-gray-700 mb-2">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="w-full p-2 border rounded-lg" placeholder="Masukkan Nama Lengkap">
        </div>
        <div>
          <label class="block text-gray-700 mb-2">Nomor Identitas</label>
          <input type="text" name="nomor_identitas" class="w-full p-2 border rounded-lg" placeholder="Masukkan Nomor Identitas">
        </div>
        <div>
          <label class="block text-gray-700 mb-2">Upload file identitas (jpg, jpeg, png, pdf)</label>
          <input type="file" name="file_identitas" accept=".jpg,.jpeg,.png,.pdf" class="w-full p-2 border rounded-lg">
        </div>
      </div>
      <div class="w-full md:w-1/2">
        <div>
          <label class="block text-gray-700 mb-2">Alamat</label>
          <input type="text" name="alamat" class="w-full p-2 border rounded-lg" placeholder="Masukkan Alamat">
        </div>
        <div>
          <label class="block text-gray-700 mb-2">No HP</label>
          <input type="text" name="no_hp" class="w-full p-2 border rounded-lg" placeholder="Masukkan No HP">
        </div>
        <div>
          <label class="block text-gray-700 mb-2">Email</label>
          <input type="email" name="email" class="w-full p-2 border rounded-lg" placeholder="Masukkan Email">
        </div>
        <div>
          <label class="block text-gray-700 mb-2">Nama Unit Kerja/Fakultas/Instansi</label>
          <input type="text" name="nama_unit_kerja_fakultas_instansi" class="w-full p-2 border rounded-lg" placeholder="Masukkan Nama Unit Kerja/Fakultas/Instansi">
        </div>
      </div>
    </div>

    <!-- Pelapor dan Terlapor -->
    <div class="mb-8 border rounded-lg p-4 space-y-4 md:flex md:flex-row md:space-y-0 md:space-x-4 md:justify-between">
      <!-- Pelapor -->
      <div class="w-full md:w-1/2">
        <h2 class="text-xl font-bold mb-4">Pelapor</h2>
        <div>
          <label class="block text-gray-700 mb-2">Status Pelapor</label>
          <select name="status_pelapor" class="w-full p-2 border rounded-lg">
            <option value="" disabled selected>Pilih Status Pelapor</option>
            <option>Mahasiswa</option>
            <option>Dosen</option>
            <option>Tenaga Kependidikan</option>
            <option>Masyarakat Umum</option>
          </select>
        </div>
        <div>
          <label class="block text-gray-700 mb-2">Kategori</label>
          <select name="kategori" class="w-full p-2 border rounded-lg">
            <option value="" disabled selected>Pilih Kategori</option>
            <option>Korban</option>
            <option>Pelapor/Saksi</option>
          </select>
        </div>
      </div>

      <!-- Terlapor -->
      <div class="w-full md:w-1/2">
        <h2 class="text-xl font-bold mb-4">Terlapor</h2>
        <div>
          <label class="block text-gray-700 mb-2">Nama Lengkap Terlapor</label>
          <input type="text" name="nama_lengkap_terlapor" class="w-full p-2 border rounded-lg" placeholder="Masukkan Nama Lengkap Terlapor">
        </div>
        <div>
          <label class="block text-gray-700 mb-2">Status Terlapor</label>
          <select name="status_terlapor" class="w-full p-2 border rounded-lg">
            <option value="" disabled selected>Pilih Status Terlapor</option>
            <option>Mahasiswa</option>
            <option>Dosen</option>
            <option>Tenaga Kependidikan</option>
            <option>Masyarakat Umum</option>
          </select>
        </div>
        <div>
          <label class="block text-gray-700 mb-2">No HP Terlapor</label>
          <input type="text" name="no_hp_terlapor" class="w-full p-2 border rounded-lg" placeholder="Masukkan No HP Terlapor">
        </div>
      </div>
    </div>

    <!-- Peristiwa -->
    <div class="mb-8 border rounded-lg p-4 space-y-4">
      <h2 class="text-xl font-bold mb-4">Peristiwa</h2>
      <div>
        <label class="block text-gray-700 mb-2">Jenis Peristiwa</label>
        <input type="text" name="peristiwa" class="w-full p-2 border rounded-lg" placeholder="Masukkan Jenis Peristiwa">
      </div>
      <div>
        <label class="block text-gray-700 mb-2">Tanggal Peristiwa</label>
        <input type="date" name="tanggal_peristiwa" class="w-full p-2 border rounded-lg">
      </div>
      <div>
        <label class="block text-gray-700 mb-2">Lokasi Peristiwa</label>
        <input type="text" name="lokasi_peristiwa" class="w-full p-2 border rounded-lg" placeholder="Masukkan Lokasi Peristiwa">
      </div>
      <div>
        <label class="block text-gray-700 mb-2">Kronologi Peristiwa</label>
        <textarea name="kronologi_peristiwa" class="w-full p-2 border rounded-lg" rows="5" placeholder="Masukkan Kronologi Peristiwa"></textarea>
      </div>
      <div>
        <label class="block text-gray-700 mb-2">Upload Bukti Tindakan (jpg, jpeg, png, pdf)</label>
        <input type="file" name="file_bukti_tindakan" accept=".jpg,.jpeg,.png,.pdf" class="w-full p-2 border rounded-lg">
      </div>
    </div>

    <!-- Tombol Submit -->
    <div class="flex justify-end">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </div>
  </form>
</div>
@endsection
@section('script')
<!-- Include SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelector('form').addEventListener('submit', function(event) {
  let isValid = true;
  const inputs = document.querySelectorAll('input, textarea, select');
  inputs.forEach(input => {
    if (input.value.trim() === '' && !input.disabled) {
      isValid = false;
      input.classList.add('border-red-500');
    } else {
      input.classList.remove('border-red-500');
    }
  });
  if (!isValid) {
    event.preventDefault();
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Tidak boleh ada form yang kosong'
    });
  }
});
</script>
@endsection