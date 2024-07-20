<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::all();
        return view('pageadmin.dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        return view('pageadmin.dokumen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:200048',
        ]);

        $fileName = time().'.'.$request->file->extension();  
        $request->file->move(public_path('dokumen'), $fileName);

        Dokumen::create([
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'file' => $fileName,
        ]);

        Alert::success('Success', 'Dokumen created successfully.');

        return redirect()->route('dokumens.index');
    }

    public function show($id)
    {
        $dokumen = Dokumen::find($id);
        return view('pageadmin.dokumen.show', compact('dokumen'));
    }

    public function edit($id)
    {
        $dokumen = Dokumen::find($id);
        return view('pageadmin.dokumen.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'file' => 'mimes:pdf,doc,docx|max:200048',
        ]);

        $dokumen = Dokumen::find($id);

        // Hapus file lama jika ada file baru diunggah
        if ($request->hasFile('file')) {
            $oldFile = public_path('dokumen/' . $dokumen->file);
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }

            $fileName = time().'.'.$request->file->extension();  
            $request->file->move(public_path('dokumen'), $fileName);
            $dokumen->file = $fileName;
        }

        $dokumen->title = $request->title;
        $dokumen->deskripsi = $request->deskripsi;
        $dokumen->save();

        Alert::success('Success', 'Dokumen updated successfully.');

        return redirect()->route('dokumens.index');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::find($id);

        // Hapus file terkait sebelum menghapus dokumen dari database
        $filePath = public_path('dokumen/' . $dokumen->file);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $dokumen->delete();

        Alert::success('Success', 'Dokumen deleted successfully.');

        return redirect()->route('dokumens.index');
    }
}
