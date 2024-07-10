@extends('template-admin.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Kegiatan</h4>

        <div class="mb-3">
            <a href="/kegiatans/create" class="btn btn-sm btn-primary">Tambah Kegiatan</a>
        </div>

        <div class="card">
            <h5 class="card-header">Kegiatan</h5>
            <div class="table-responsive text-nowrap p-4">
                <table id="example" class="display compact nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>TITLE</th>
                            <th>DESKRIPSI</th>
                            <th>GAMBAR</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kegiatans as $kegiatan)
                            <tr>
                               <td>{{ $kegiatan->title }}</td>
                               <td>{{ $kegiatan->deskripsi }}</td>
                               <td>
                                   <img src="{{ asset('kegiatan/' . $kegiatan->gambar) }}" alt="Gambar" width="100">
                               </td>
                                <td>
                                    <a href="{{ route('kegiatans.edit', $kegiatan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('kegiatans.destroy', $kegiatan->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[method="POST"]');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak akan dapat mengembalikan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
