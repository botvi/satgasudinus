<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::all();
        return view('pageadmin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('pageadmin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('kegiatan'), $imageName);

        Kegiatan::create([
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imageName,
        ]);

        Alert::success('Success', 'Kegiatan created successfully.');

        return redirect()->route('kegiatans.index');
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('pageadmin.kegiatan.show', compact('kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('pageadmin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $kegiatan = Kegiatan::find($id);

        if($request->hasFile('gambar')) {
            // Delete the old image
            if(File::exists(public_path('kegiatan/'.$kegiatan->gambar))) {
                File::delete(public_path('kegiatan/'.$kegiatan->gambar));
            }

            // Store the new image
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('kegiatan'), $imageName);
            $kegiatan->gambar = $imageName;
        }

        $kegiatan->title = $request->title;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->save();

        Alert::success('Success', 'Kegiatan updated successfully.');

        return redirect()->route('kegiatans.index');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::find($id);

        // Delete the image
        if(File::exists(public_path('kegiatan/'.$kegiatan->gambar))) {
            File::delete(public_path('kegiatan/'.$kegiatan->gambar));
        }

        $kegiatan->delete();

        Alert::success('Success', 'Kegiatan deleted successfully.');

        return redirect()->route('kegiatans.index');
    }
}
