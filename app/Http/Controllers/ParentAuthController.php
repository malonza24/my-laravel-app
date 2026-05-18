<?php

namespace App\Http\Controllers;

use App\Models\ParentGuardian;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParentAuthController extends Controller
{
    public function showRegister()
    {
        return view('parent.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|min:2|max:100',
            'email'     => 'required|email|unique:parents',
            'phone'     => 'required|unique:parents|min:10|max:15',
            'id_number' => 'required|unique:parents|min:6|max:20',
            'password'  => 'required|min:6|confirmed',
        ]);

        $parent = ParentGuardian::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'id_number' => $request->id_number,
            'password'  => Hash::make($request->password),
        ]);

        ActivityLog::create([
            'loggable_type' => 'ParentGuardian',
            'loggable_id'   => $parent->id,
            'action'        => 'registered',
            'description'   => "Parent {$parent->name} registered",
            'performed_by'  => $parent->name,
        ]);

        Auth::guard('parent')->login($parent);
        return redirect('/parent/dashboard');
    }

    public function showLogin()
    {
        return view('parent.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $parent = ParentGuardian::where('email', $request->email)->first();

        if ($parent && $parent->isBlocked()) {
            return back()->withErrors(['email' => 'Your account has been blocked. Contact admin.']);
        }

        if (Auth::guard('parent')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/parent/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('parent')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/parent/login');
    }
}