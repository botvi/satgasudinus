<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPasswordController extends Controller
{
    public function showVerifyPasswordForm()
    {
        return view('auth.verify-password');
    }

    public function verifyPassword(Request $request)
    {
        $request->validate([
            'pin' => 'required',
        ]);

        if ($request->pin === Auth::user()->pin) {
            $request->session()->put('pin_verified', true);
            return redirect($request->input('redirect_to') ?? route('lapor.index'));
        } else {
            Alert::error('Error', 'PIN salah.');
            return redirect()->route('admin.verify-password');
        }
    }
}
