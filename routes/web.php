<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParentAuthController;
use App\Http\Controllers\ParentDashboardController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\DashboardController;

// Landing page
Route::get('/', fn() => view('landing'));

// Admin auth routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/admin/register', [AuthController::class, 'register']);

// Admin protected routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/parents', [AdminController::class, 'parents'])->name('admin.parents');
    Route::get('/parents/{id}', [AdminController::class, 'viewParent'])->name('admin.view-parent');
    Route::get('/parents/{id}/edit', [AdminController::class, 'editParent'])->name('admin.edit-parent');
    Route::post('/parents/{id}/edit', [AdminController::class, 'updateParent']);
    Route::post('/parents/{id}/toggle-block', [AdminController::class, 'toggleBlock'])->name('admin.toggle-block');
    Route::post('/parents/{id}/delete', [AdminController::class, 'deleteParent'])->name('admin.delete-parent');
    Route::get('/children', [AdminController::class, 'children'])->name('admin.children');
    Route::post('/children/{id}/checkin', [AdminController::class, 'checkIn'])->name('admin.checkin');
    Route::post('/children/{id}/checkout', [AdminController::class, 'checkOut'])->name('admin.checkout');
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::post('/payments/{id}/confirm', [AdminController::class, 'confirmPayment'])->name('admin.confirm-payment');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'updateSettings']);
    Route::get('/activity', [AdminController::class, 'activityLogs'])->name('admin.activity');
});

// Parent auth routes
Route::get('/parent/register', [ParentAuthController::class, 'showRegister'])->name('parent.register');
Route::post('/parent/register', [ParentAuthController::class, 'register']);
Route::get('/parent/login', [ParentAuthController::class, 'showLogin'])->name('parent.login');
Route::post('/parent/login', [ParentAuthController::class, 'login']);
Route::post('/parent/logout', [ParentAuthController::class, 'logout'])->name('parent.logout');

// Parent protected routes
Route::middleware(['auth:parent'])->group(function () {
    Route::get('/parent/dashboard', [ParentDashboardController::class, 'index'])->name('parent.dashboard');
    Route::get('/parent/child/register', [ChildController::class, 'create'])->name('child.create');
    Route::post('/parent/child/register', [ChildController::class, 'store'])->name('child.store');
    Route::post('/parent/child/{id}/checkout', [ChildController::class, 'checkout'])->name('child.checkout');
    Route::get('/parent/payment/{childId}', [MpesaController::class, 'showPayment'])->name('payment.show');
    Route::post('/parent/payment/{childId}', [MpesaController::class, 'initiate'])->name('payment.initiate');
    Route::get('/parent/payment/success/{paymentId}', [MpesaController::class, 'success'])->name('payment.success');
    Route::get('/parent/payment/waiting/{paymentId}', fn($id) => view('parent.payment-waiting', ['paymentId' => $id]))->name('payment.waiting');
});

// Mpesa callback
Route::post('/mpesa/callback', [MpesaController::class, 'callback']);