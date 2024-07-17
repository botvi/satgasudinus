<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        .section h5 {
            background-color: #007bff;
            color: white;
            padding: 10px;
        }
        .section table {
            width: 100%;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .section th, .section td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .section th {
            background-color: #f2f2f2;
        }
        .strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Laporan /</span> {{ $lapor->nama_lengkap }}</h4>
        </div>

        <div class="section">
            <h5 class="text-primary">Identitas</h5>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Data</th>
                </tr>
                <tr>
                    <td><strong>Nama Lengkap:</strong></td>
                    <td>{{ $lapor->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td><strong>Nomor Identitas:</strong></td>
                    <td>{{ $lapor->nomor_identitas }}</td>
                </tr>
                <tr>
                    <td><strong>Alamat:</strong></td>
                    <td>{{ $lapor->alamat }}</td>
                </tr>
                <tr>
                    <td><strong>No. HP:</strong></td>
                    <td>{{ $lapor->no_hp }}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $lapor->email }}</td>
                </tr>
                <tr>
                    <td><strong>Unit Kerja / Fakultas / Instansi:</strong></td>
                    <td>{{ $lapor->nama_unit_kerja_fakultas_instansi }}</td>
                </tr>
                <tr>
                    <td><strong>File Identitas:</strong></td>
                    <td>
                        @if ($lapor->file_identitas)
                            
                            <a href="{{ asset('identitas/' . $lapor->file_identitas) }}" target="_blank">{{ asset('identitas/' . $lapor->file_identitas) }}</a>

                        @else
                            Tidak ada file identitas
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h5 class="text-primary">Pelapor</h5>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Data</th>
                </tr>
                <tr>
                    <td><strong>Status Pelapor:</strong></td>
                    <td>{{ $lapor->status_pelapor }}</td>
                </tr>
                <tr>
                    <td><strong>Kategori:</strong></td>
                    <td>{{ $lapor->kategori }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h5 class="text-primary">Terlapor</h5>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Data</th>
                </tr>
                <tr>
                    <td><strong>Nama Lengkap Terlapor:</strong></td>
                    <td>{{ $lapor->nama_lengkap_terlapor }}</td>
                </tr>
                <tr>
                    <td><strong>Status Terlapor:</strong></td>
                    <td>{{ $lapor->status_terlapor }}</td>
                </tr>
                <tr>
                    <td><strong>No. HP Terlapor:</strong></td>
                    <td>{{ $lapor->no_hp_terlapor }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h5 class="text-primary">Peristiwa</h5>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Data</th>
                </tr>
                <tr>
                    <td><strong>Peristiwa:</strong></td>
                    <td>{{ $lapor->peristiwa }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Peristiwa:</strong></td>
                    <td>{{ $lapor->tanggal_peristiwa }}</td>
                </tr>
                <tr>
                    <td><strong>Lokasi Peristiwa:</strong></td>
                    <td>{{ $lapor->lokasi_peristiwa }}</td>
                </tr>
                <tr>
                    <td><strong>Kronologi Peristiwa:</strong></td>
                    <td>{!! nl2br(e($lapor->kronologi_peristiwa)) !!}</td>
                </tr>
                <tr>
                    <td><strong>File Bukti Tindakan:</strong></td>
                    <td>
                        @if ($lapor->file_bukti_tindakan)
                        <a href="{{ asset('buktitindakan/' . $lapor->file_bukti_tindakan) }}" target="_blank">{{ asset('buktitindakan/' . $lapor->file_bukti_tindakan) }}</a>

                        @else
                            Tidak ada file bukti tindakan
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
