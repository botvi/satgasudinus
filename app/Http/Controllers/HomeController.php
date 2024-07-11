<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\Dokumen;
use App\Models\Kegiatan;

class HomeController extends Controller
{
    public function home()
    {
        // Mengambil maksimal 3 data dari model Galeri, Dokumen, dan Kegiatan
        $galeri = Galeri::latest()->take(3)->get();
        $dokumen = Dokumen::latest()->take(3)->get();
        $kegiatan = Kegiatan::latest()->take(3)->get();

        return view('pageweb.home', compact('galeri', 'dokumen', 'kegiatan'));
    }
}
