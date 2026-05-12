<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

// Show the form
Route::get('/', [WelcomeController::class, 'index']);

// Handle form submission
Route::post('/greet', [WelcomeController::class, 'greet']);