<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ParentDashboardController extends Controller
{
    public function index()
    {
        $parent   = Auth::guard('parent')->user();
        $children = $parent->children()->with('payments')->get();
        return view('parent.dashboard', compact('parent', 'children'));
    }
}