<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::all();
        return view('pageadmin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('pageadmin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('galeri'), $imageName);

        Galeri::create([
            'gambar' => $imageName,
        ]);

        Alert::success('Success', 'Gambar galeri berhasil disimpan.');

        return redirect()->route('galeris.index');
    }

    public function show($id)
    {
        $galeri = Galeri::find($id);
        return view('pageadmin.galeri.show', compact('galeri'));
    }

    public function edit($id)
    {
        $galeri = Galeri::find($id);
        return view('pageadmin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galeri = Galeri::find($id);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('galeri'), $imageName);
            $galeri->gambar = $imageName;
        }

        $galeri->save();

        Alert::success('Success', 'Gambar galeri berhasil diperbarui.');

        return redirect()->route('galeris.index');
    }

    public function destroy($id)
    {
        $galeri = Galeri::find($id);

        // Hapus file gambar dari direktori
        $gambarPath = public_path('galeri').'/'.$galeri->gambar;
        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }

        $galeri->delete();

        Alert::success('Success', 'Gambar galeri berhasil dihapus.');

        return redirect()->route('galeris.index');
    }
}
