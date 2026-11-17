<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenghuniController;
use Illuminate\Support\Facades\Route;

// ---- Hanya untuk yang BELUM login ----
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ---- Logout ----
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ---- Hanya untuk yang SUDAH login ----
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('penghuni.index');
    });

    // Semua fitur KECUALI hapus: boleh pemilik & penghuni
    Route::resource('penghuni', PenghuniController::class)
        ->except('destroy')
        ->middleware('role:pemilik,penghuni');

    // Hapus: HANYA pemilik
    Route::delete('penghuni/{penghuni}', [PenghuniController::class, 'destroy'])
        ->name('penghuni.destroy')
        ->middleware('role:pemilik');
});