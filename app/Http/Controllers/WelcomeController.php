<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome-form');
    }

    public function greet(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50'
        ]);

        $name = $request->input('name');
        return view('welcome-message', compact('name'));
    }
}