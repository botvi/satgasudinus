@extends('template-admin.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Dokumen</h4>

        <div class="mb-3">
            <a href="{{ route('dokumens.create') }}" class="btn btn-sm btn-primary">Tambah Dokumen</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="example" class="display compact nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>JUDUL</th>
                                <th>DESKRIPSI</th>
                                <th>FILE</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumens as $dokumen)
                                <tr>
                                    <td>{{ $dokumen->title }}</td>
                                    <td>{{ $dokumen->deskripsi }}</td>
                                    <td>
                                        <a href="{{ asset('dokumen/' . $dokumen->file) }}" target="_blank">Lihat File</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('dokumens.edit', $dokumen->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('dokumens.destroy', $dokumen->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const form = this;

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
