<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'nomor_identitas',
        'file_identitas',
        'alamat',
        'no_hp',
        'email',
        'nama_unit_kerja_fakultas_instansi',
        'status_pelapor',
        'kategori',
        'nama_lengkap_terlapor',
        'status_terlapor',
        'no_hp_terlapor',
        'peristiwa',
        'tanggal_peristiwa',
        'lokasi_peristiwa',
        'kronologi_peristiwa',
        'file_bukti_tindakan',
    ];
}
