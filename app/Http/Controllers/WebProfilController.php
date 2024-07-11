<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebProfilController extends Controller
{
    public function pengantar (){
        return view('pageweb.profil.pengantar');
    }
    public function filosofi (){
        return view('pageweb.profil.filosofi');
    }
}
