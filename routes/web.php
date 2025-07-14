<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusNotificationMail;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\AdminDashboardController;
use App\Models\RamsForm;

// ─────────────────────────────
// Public Routes
// ─────────────────────────────
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/guideline', function () {
    return view('guideline');
})->name('guideline');

Route::get('/form/create', [FormController::class, 'create'])->name('form.create');
Route::post('/form/store', [FormController::class, 'store'])->name('form.store');

// ─────────────────────────────
// Admin Auth Routes
// ─────────────────────────────
Route::prefix('admin')->group(function () {
    // Registration
    Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('form.register-admin');
    Route::post('/register', [AdminController::class, 'register'])->name('form.register-admin');

    // Login
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login-admin');
    Route::post('/login', [AdminController::class, 'login'])->name('form.login-admin');

    // Dashboard (protected)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');

    // Dashboard Features
    Route::get('/download/{id}', [AdminDashboardController::class, 'download'])->name('admin.download')->middleware('auth:admin');
    Route::post('/update-status/{id}', [AdminDashboardController::class, 'updateStatus'])->name('admin.update-status')->middleware('auth:admin');

    // Forgot & Reset Password
    Route::get('/forgot-password', [ForgotController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/forgot-password', [ForgotController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    Route::get('/reset-password/{token}', [ResetController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('/reset-password', [ResetController::class, 'reset'])->name('admin.password.update');

    // Alias to fix: Route [password.reset] not defined
    Route::get('/reset-password/{token}', [ResetController::class, 'showResetForm'])->name('password.reset');
});

// ─────────────────────────────
// Logout Route
// ─────────────────────────────
Route::post('/logout', function () {
    Auth::guard('admin')->logout();
    return redirect()->route('login-admin');
})->name('logout');

// ─────────────────────────────
// Test Email Route
// ─────────────────────────────
Route::get('/test-email', function () {
    $ramsForm = RamsForm::first();
    if (!$ramsForm) {
        return '❌ No RamsForm record found.';
    }
    Mail::to('alyaashuhada01@gmail.com')->send(new StatusNotificationMail($ramsForm));
    return '✅ Test email sent.';
});
