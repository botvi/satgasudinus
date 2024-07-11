<?php

namespace App\Http\Controllers;

use App\Models\Lapor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WebLaporController extends Controller
{
    public function lapor()
    {
        return view('pageweb.lapor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nomor_identitas' => 'required',
            'file_identitas' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'nama_unit_kerja_fakultas_instansi' => 'required',
            'status_pelapor' => 'required',
            'kategori' => 'required',
            'nama_lengkap_terlapor' => 'required',
            'status_terlapor' => 'required',
            'no_hp_terlapor' => 'required',
            'peristiwa' => 'required',
            'tanggal_peristiwa' => 'required|date',
            'lokasi_peristiwa' => 'required',
            'kronologi_peristiwa' => 'required',
            'file_bukti_tindakan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        
        // Jika validasi berhasil, lanjutkan proses penyimpanan data
        $fileIdentitasName = time() . '_identitas.' . $request->file_identitas->extension();
        $request->file_identitas->move(public_path('identitas'), $fileIdentitasName);
        
        $fileBuktiName = time() . '_bukti.' . $request->file_bukti_tindakan->extension();
        $request->file_bukti_tindakan->move(public_path('buktitindakan'), $fileBuktiName);
        
        Lapor::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_identitas' => $request->nomor_identitas,
            'file_identitas' => $fileIdentitasName,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'nama_unit_kerja_fakultas_instansi' => $request->nama_unit_kerja_fakultas_instansi,
            'status_pelapor' => $request->status_pelapor,
            'kategori' => $request->kategori,
            'nama_lengkap_terlapor' => $request->nama_lengkap_terlapor,
            'status_terlapor' => $request->status_terlapor,
            'no_hp_terlapor' => $request->no_hp_terlapor,
            'peristiwa' => $request->peristiwa,
            'tanggal_peristiwa' => $request->tanggal_peristiwa,
            'lokasi_peristiwa' => $request->lokasi_peristiwa,
            'kronologi_peristiwa' => $request->kronologi_peristiwa,
            'file_bukti_tindakan' => $fileBuktiName,
        ]);
        
        Alert::success('Success', 'Laporan berhasil dibuat.');
        
        return redirect()->route('web.lapor');
    }
}
