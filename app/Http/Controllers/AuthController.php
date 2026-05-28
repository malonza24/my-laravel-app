<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|max:255',
            'password' => 'required|min:6|max:255',
        ]);

        // Rate limiting
        $key = 'admin-login:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            Log::warning('Admin login rate limit exceeded', [
                'ip'    => $request->ip(),
                'email' => $request->input('email'),
            ]);
            return back()->withErrors([
                'email' => "Too many login attempts. Try again in {$seconds} seconds.",
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            // Log successful login
            ActivityLog::create([
                'loggable_type' => 'User',
                'loggable_id'   => Auth::id(),
                'action'        => 'admin_login',
                'description'   => 'Admin logged in from IP: ' . $request->ip(),
                'performed_by'  => Auth::user()->name,
            ]);

            return redirect('/admin/dashboard');
        }

        RateLimiter::hit($key, 300);

        // Log failed attempt
        Log::warning('Failed admin login attempt', [
            'ip'    => $request->ip(),
            'email' => $request->input('email'),
        ]);

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        ActivityLog::create([
            'loggable_type' => 'User',
            'loggable_id'   => Auth::id(),
            'action'        => 'admin_logout',
            'description'   => 'Admin logged out',
            'performed_by'  => Auth::user()->name ?? 'System',
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login')->with('success', 'Logged out successfully.');
    }
}