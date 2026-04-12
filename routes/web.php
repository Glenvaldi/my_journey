<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController; 

Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/tentang-kami', function () { return view('about'); })->name('about');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/petunjuk-tes', function() { return view('instructions'); })->name('instructions');
    Route::get('/tes-bakat', [TestController::class, 'index'])->name('test.index');
    Route::post('/submit', [TestController::class, 'store'])->name('test.submit');
    Route::get('/riwayat-saya', [TestController::class, 'history'])->name('test.history');
    Route::get('/riwayat/{id}', [TestController::class, 'show'])->name('test.show');
});

// ROUTE ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/user/{id}/history', [AdminController::class, 'userHistory'])->name('admin.user.history');
    
    // --- TAMBAHAN PENTING: DETAIL HISTORY VERSI ADMIN ---
    // Rute ini membolehkan admin melihat detail ID manapun
    Route::get('/history/{id}/detail', [AdminController::class, 'show'])->name('admin.history.show'); 
    // ----------------------------------------------------
});