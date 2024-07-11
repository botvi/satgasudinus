<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class WebGaleriController extends Controller
{
    public function galeri()
    {
        $galeris = Galeri::all();
        return view('pageweb.galeri', compact('galeris'));
    }
}
