<?php

namespace App\Http\Controllers;

use App\Models\Lapor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
class LaporController extends Controller
{

    public function download($id)
    {
        $lapor = Lapor::findOrFail($id);
    
        $pdf = Pdf::loadView('pageadmin.lapor.pdf', compact('lapor'));
        return $pdf->download('laporan-'.$lapor->id.'.pdf');
    }


    public function index()
    {
        $lapors = Lapor::all();

        $totalLapor = Lapor::count();

        $countStatusPelapor = Lapor::selectRaw('status_pelapor, COUNT(*) as count')
            ->groupBy('status_pelapor')
            ->pluck('count', 'status_pelapor');
    
        $countStatusTerlapor = Lapor::selectRaw('status_terlapor, COUNT(*) as count')
            ->groupBy('status_terlapor')
            ->pluck('count', 'status_terlapor');
    
        return view('pageadmin.lapor.index', compact('lapors', 'countStatusPelapor', 'countStatusTerlapor','totalLapor'));
    }
    

    // public function create()
    // {
    //     return view('pageadmin.lapor.create');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nomor_identitas' => 'required',
            'file_identitas' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
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
            'file_bukti_tindakan' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

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

        return redirect()->route('lapor.index');
    }

    public function show($id)
    {
        $lapor = Lapor::find($id);
        return view('pageadmin.lapor.show', compact('lapor'));
    }
    

    public function edit($id)
    {
        $lapor = Lapor::find($id);
        return view('pageadmin.lapor.edit', compact('lapor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nomor_identitas' => 'required',
            'file_identitas' => 'mimes:jpg,jpeg,png,pdf|max:2048',
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
            'file_bukti_tindakan' => 'mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $lapor = Lapor::find($id);

        if ($request->hasFile('file_identitas')) {
            $fileIdentitasName = time() . '_identitas.' . $request->file_identitas->extension();
            $request->file_identitas->move(public_path('identitas'), $fileIdentitasName);
            $lapor->file_identitas = $fileIdentitasName;
        }

        if ($request->hasFile('file_bukti_tindakan')) {
            $fileBuktiName = time() . '_bukti.' . $request->file_bukti_tindakan->extension();
            $request->file_bukti_tindakan->move(public_path('buktitindakan'), $fileBuktiName);
            $lapor->file_bukti_tindakan = $fileBuktiName;
        }

        $lapor->nama_lengkap = $request->nama_lengkap;
        $lapor->nomor_identitas = $request->nomor_identitas;
        $lapor->alamat = $request->alamat;
        $lapor->no_hp = $request->no_hp;
        $lapor->email = $request->email;
        $lapor->nama_unit_kerja_fakultas_instansi = $request->nama_unit_kerja_fakultas_instansi;
        $lapor->status_pelapor = $request->status_pelapor;
        $lapor->kategori = $request->kategori;
        $lapor->nama_lengkap_terlapor = $request->nama_lengkap_terlapor;
        $lapor->status_terlapor = $request->status_terlapor;
        $lapor->no_hp_terlapor = $request->no_hp_terlapor;
        $lapor->peristiwa = $request->peristiwa;
        $lapor->tanggal_peristiwa = $request->tanggal_peristiwa;
        $lapor->lokasi_peristiwa = $request->lokasi_peristiwa;
        $lapor->kronologi_peristiwa = $request->kronologi_peristiwa;

        $lapor->save();

        Alert::success('Success', 'Laporan berhasil diperbarui.');

        return redirect()->route('lapor.index');
    }

    public function destroy($id)
    {
        $lapor = Lapor::find($id);

        $fileIdentitasPath = public_path('identitas') . '/' . $lapor->file_identitas;
        if (file_exists($fileIdentitasPath)) {
            unlink($fileIdentitasPath);
        }

        $fileBuktiPath = public_path('buktitindakan') . '/' . $lapor->file_bukti_tindakan;
        if (file_exists($fileBuktiPath)) {
            unlink($fileBuktiPath);
        }

        $lapor->delete();

        Alert::success('Success', 'Laporan berhasil dihapus.');

        return redirect()->route('lapor.index');
    }
}
