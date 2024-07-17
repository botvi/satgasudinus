<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyAdminPassword
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !$request->session()->has('admin_password_verified')) {
            return redirect()->route('admin.verify-password');
        }

        return $next($request);
    }
}
