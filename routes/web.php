<?php

use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Peserta\EventController as PesertaEventController;
use App\Http\Controllers\Peserta\RegistrationController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

/*
|--------------------------------------------------------------------------
| Autentikasi (Admin & Peserta menggunakan satu form login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Area Admin (Penyelenggara)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class)->except(['show']);
    Route::get('/events/{event}/peserta', [AdminEventController::class, 'peserta'])->name('events.peserta');
    Route::patch('/events/{event}/peserta/{registration}/confirm', [AdminEventController::class, 'confirm'])->name('events.peserta.confirm');

    Route::resource('kupon', CouponController::class)->parameters(['kupon' => 'kupon'])->except(['show']);
    Route::patch('/kupon/{kupon}/toggle', [CouponController::class, 'toggle'])->name('kupon.toggle');
});

/*
|--------------------------------------------------------------------------
| Area Peserta (Public User)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'peserta'])->prefix('peserta')->name('peserta.')->group(function () {
    Route::get('/events', [PesertaEventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}/daftar', [RegistrationController::class, 'create'])->name('events.daftar');
    Route::post('/events/{event}/daftar', [RegistrationController::class, 'store'])->name('events.daftar.store');
    Route::get('/riwayat', [RegistrationController::class, 'riwayat'])->name('riwayat');
    Route::get('/pendaftaran/{registration}/edit', [RegistrationController::class, 'edit'])->name('pendaftaran.edit');
    Route::patch('/pendaftaran/{registration}', [RegistrationController::class, 'update'])->name('pendaftaran.update');
});
