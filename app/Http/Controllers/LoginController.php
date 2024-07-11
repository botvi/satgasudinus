<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert; // Import facade SweetAlert

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            Alert::success('Login Successful', 'Welcome back!');
            return redirect()->intended('dashboard');
        }

        // Authentication failed...
        Alert::error('Login Failed', 'The provided credentials do not match our records.');
        return back();
    }

    /**
     * Handle logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        Alert::info('Logged Out', 'You have been logged out.');
        return redirect('/kelolasatgas');
    }
}
