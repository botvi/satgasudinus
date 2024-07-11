<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class WebDokumenController extends Controller
{
    public function dokumen()
    {
        $dokumens = Dokumen::all();
        return view('pageweb.dokumen', compact('dokumens'));
    }
}
