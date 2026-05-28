<?php

namespace App\Http\Controllers;

use App\Models\ParentGuardian;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class ParentAuthController extends Controller
{
    public function showRegister()
    {
        if (Auth::guard('parent')->check()) {
            return redirect('/parent/dashboard');
        }
        return view('parent.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|min:2|max:100|regex:/^[a-zA-Z\s]+$/',
            'email'     => 'required|email|max:255|unique:parents,email',
            'phone'     => 'required|string|min:10|max:13|unique:parents,phone',
            'id_number' => 'required|string|min:6|max:20|unique:parents,id_number',
            'password'  => 'required|string|min:8|max:255|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'name.regex'     => 'Name can only contain letters and spaces.',
        ]);

        $parent = ParentGuardian::create([
            'name'      => strip_tags(trim($request->name)),
            'email'     => strtolower(trim($request->email)),
            'phone'     => trim($request->phone),
            'id_number' => trim($request->id_number),
            'password'  => Hash::make($request->password),
            'status'    => 'active',
        ]);

        ActivityLog::create([
            'loggable_type' => 'ParentGuardian',
            'loggable_id'   => $parent->id,
            'action'        => 'parent_registered',
            'description'   => "New parent registered: {$parent->name} from IP: " . $request->ip(),
            'performed_by'  => $parent->name,
        ]);

        Auth::guard('parent')->login($parent);
        $request->session()->regenerate();

        return redirect('/parent/dashboard')->with('success', 'Account created successfully! Welcome to Diligent Mom.');
    }

    public function showLogin()
    {
        if (Auth::guard('parent')->check()) {
            return redirect('/parent/dashboard');
        }
        return view('parent.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|max:255',
            'password' => 'required|string|min:6|max:255',
        ]);

        // Rate limiting
        $key = 'parent-login:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            Log::warning('Parent login rate limit exceeded', [
                'ip'    => $request->ip(),
                'email' => $request->input('email'),
            ]);
            return back()->withErrors([
                'email' => "Too many login attempts. Try again in {$seconds} seconds.",
            ]);
        }

        $parent = ParentGuardian::where('email', strtolower(trim($request->email)))->first();

        if (!$parent || !Hash::check($request->password, $parent->password)) {
            RateLimiter::hit($key, 300);
            Log::warning('Failed parent login attempt', [
                'ip'    => $request->ip(),
                'email' => $request->input('email'),
            ]);
            return back()->withErrors([
                'email' => 'The provided credentials are incorrect.',
            ])->withInput($request->only('email'));
        }

        if ($parent->isBlocked()) {
            RateLimiter::hit($key, 300);
            return back()->withErrors([
                'email' => 'Your account has been suspended. Please contact the daycare.',
            ]);
        }

        RateLimiter::clear($key);
        Auth::guard('parent')->login($parent);
        $request->session()->regenerate();

        ActivityLog::create([
            'loggable_type' => 'ParentGuardian',
            'loggable_id'   => $parent->id,
            'action'        => 'parent_login',
            'description'   => "Parent {$parent->name} logged in from IP: " . $request->ip(),
            'performed_by'  => $parent->name,
        ]);

        return redirect('/parent/dashboard');
    }

    public function logout(Request $request)
    {
        $parent = Auth::guard('parent')->user();

        if ($parent) {
            ActivityLog::create([
                'loggable_type' => 'ParentGuardian',
                'loggable_id'   => $parent->id,
                'action'        => 'parent_logout',
                'description'   => "Parent {$parent->name} logged out",
                'performed_by'  => $parent->name,
            ]);
        }

        Auth::guard('parent')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/parent/login')->with('success', 'Logged out successfully.');
    }
}