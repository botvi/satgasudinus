<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

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

    public function showChangePinForm()
    {
        return view('auth.change-pin');
    }


public function changePin(Request $request)
{
    $request->validate([
        'current_pin' => 'required',
        'new_pin' => 'required|min:4|confirmed',
    ]);

    $user = Auth::user();

    if ($request->current_pin !== $user->pin) {
        Alert::error('Error', 'PIN lama salah.');
        return redirect()->back();
    }

    DB::table('users')
        ->where('id', $user->id)
        ->update(['pin' => $request->new_pin]);

    Alert::success('Success', 'PIN berhasil diubah.');
    return redirect()->route('lapor.index');
}

}
