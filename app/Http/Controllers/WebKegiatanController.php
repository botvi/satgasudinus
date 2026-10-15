<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class WebKegiatanController extends Controller
{
    
    public function kegiatan()
    {
        $kegiatans = Kegiatan::latest()->get();
        return view('pageweb.kegiatan', compact('kegiatans'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $lain = Kegiatan::where('id', '!=', $id)->latest()->take(3)->get();

        return view('pageweb.kegiatan-detail', compact('kegiatan', 'lain'));
    }
}
