<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebLainnyaController extends Controller
{
    public function lainnya()
    {
        return view('pageweb.lainnya');
    }
}
