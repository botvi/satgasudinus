<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'password' => 'required',
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            $request->session()->put('password_verified', true);
            return redirect($request->input('redirect_to') ?? route('lapor.index'));
        } else {
            Alert::error('Error', 'Password salah.');
            return redirect()->route('admin.verify-password');
        }
    }
}
