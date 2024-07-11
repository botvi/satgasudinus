<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class WebKegiatanController extends Controller
{
    
    public function kegiatan()
    {
        $kegiatans = Kegiatan::all();
        return view('pageweb.kegiatan', compact('kegiatans'));
    }
}
