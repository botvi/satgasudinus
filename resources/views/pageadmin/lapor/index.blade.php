@extends('template-admin.layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Lapor</h4>

        {{-- <div class="mb-3">
            <a href="{{ route('lapor.create') }}" class="btn btn-sm btn-primary">Tambah Laporan</a>
        </div> --}}

        <div class="card">
            <h5 class="card-header">Laporan</h5>
            <div class="table-responsive text-nowrap p-4">
                <table id="example" class="display compact nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Identitas</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($lapors as $lapor)
                            <tr>
                                <td>{{ $lapor->id }}</td>
                                <td>{{ $lapor->nama_lengkap }}</td>
                                <td>{{ $lapor->nomor_identitas }}</td>
                                <td>{{ $lapor->alamat }}</td>
                                <td>{{ $lapor->no_hp }}</td>
                                <td>{{ $lapor->email }}</td>
                                <td>
                                    <a href="{{ route('lapor.show', $lapor->id) }}" class="btn btn-sm btn-info">Detail</a>
                                    <a href="{{ route('lapor.edit', $lapor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('lapor.destroy', $lapor->id) }}" method="POST" class="d-inline delete-form">
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
