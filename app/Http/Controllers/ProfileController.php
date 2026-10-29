<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('pageadmin.profil.index');
    }

    public function updateUsername(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'username' => ['required', 'string', 'min:4', 'max:50', 'alpha_dash', Rule::unique('users', 'username')->ignore($user->id)],
            'password_saat_ini' => 'required',
        ], $this->messages(), $this->attributes());

        if (! Hash::check($data['password_saat_ini'], $user->password)) {
            return back()->withErrors(['password_saat_ini' => 'Password saat ini salah.'])->withInput($request->only('username'));
        }

        $user->username = $data['username'];
        $user->save();

        Alert::success('Berhasil', 'Username berhasil diubah.');

        return redirect()->route('profil.edit');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], $this->messages(), $this->attributes());

        $user = Auth::user();
        if (! Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        Alert::success('Berhasil', 'Password berhasil diubah.');

        return redirect()->route('profil.edit');
    }

    public function updatePin(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'current_pin' => 'required',
            'new_pin' => ['required', 'string', 'min:4', 'max:20', 'confirmed', Rule::unique('users', 'pin')->ignore($user->id)],
        ], $this->messages(), $this->attributes());

        if ($data['current_pin'] !== $user->pin) {
            return back()->withErrors(['current_pin' => 'PIN saat ini salah.']);
        }

        $user->pin = $data['new_pin'];
        $user->save();

        Alert::success('Berhasil', 'PIN berhasil diubah.');

        return redirect()->route('profil.edit');
    }

    private function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'min' => ':attribute minimal :min karakter.',
            'max' => ':attribute maksimal :max karakter.',
            'confirmed' => 'Konfirmasi :attribute tidak cocok.',
            'unique' => ':attribute sudah dipakai.',
            'alpha_dash' => ':attribute hanya boleh huruf, angka, strip, dan garis bawah.',
        ];
    }

    private function attributes(): array
    {
        return [
            'username' => 'Username',
            'password_saat_ini' => 'Password saat ini',
            'current_password' => 'Password saat ini',
            'password' => 'Password baru',
            'current_pin' => 'PIN saat ini',
            'new_pin' => 'PIN baru',
        ];
    }
}
