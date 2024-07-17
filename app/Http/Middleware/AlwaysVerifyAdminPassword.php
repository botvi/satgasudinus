<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlwaysVerifyAdminPassword
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !$request->session()->has('password_verified')) {
            return redirect()->route('admin.verify-password')->with('redirect_to', $request->url());
        }

        $request->session()->forget('password_verified');

        return $next($request);
    }
}
