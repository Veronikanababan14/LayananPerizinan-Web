<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AdminPengajuanController;
use App\Http\Controllers\NotifikasiController;

/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| LANDING & PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/beranda', [LandingController::class, 'index'])->name('beranda');
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| PAGE
|--------------------------------------------------------------------------
*/
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

/*
|--------------------------------------------------------------------------
| PROFILE USER
|--------------------------------------------------------------------------
*/
Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit.profile');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::put('/change-password', [ProfileController::class, 'changePassword'])->name('password.change');
/*
|--------------------------------------------------------------------------
| LAYANAN USER
|--------------------------------------------------------------------------
*/
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{id}', [LayananController::class, 'show'])->name('layanan.show');
Route::get('/layanan/search', [LayananController::class, 'search'])->name('layanan.search');

Route::get('/dashboard-search', [LayananController::class, 'dashboardSearch'])
    ->name('dashboard.search');

/*
|--------------------------------------------------------------------------
| PERIZINAN USER
|--------------------------------------------------------------------------
*/

Route::get('/perizinan', [PerizinanController::class, 'index'])->name('perizinan.index');
Route::get('/perizinan/search', [PerizinanController::class, 'search'])->name('perizinan.search');
Route::get('/form-izin', [PerizinanController::class, 'create'])->name('form.izin');
Route::post('/form-izin', [PerizinanController::class, 'store'])->name('form.izin.store');
Route::get('/perizinan/{id}', [PerizinanController::class, 'show'])->name('perizinan.show');

Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::put('/pengajuan/{id}/upload-ulang', [PengajuanController::class, 'uploadUlang'])
    ->name('pengajuan.uploadUlang');
/*
|--------------------------------------------------------------------------
| DASHBOARD USER
|--------------------------------------------------------------------------
*/
Route::get('/dashboard-user', [DashboardController::class, 'index'])->name('dashboard.user');

/*
|--------------------------------------------------------------------------
| NOTIFIKASI USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'bacaSemua'])->name('notifikasi.bacaSemua');
    Route::post('/notifikasi/{id}/baca', [NotifikasiController::class, 'tandaiBaca'])->name('notifikasi.baca');
});
/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |------------------------------------------
    | AUTH ADMIN
    |------------------------------------------
    */
    Route::get('/login', [AdminLoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');
    // DASHBOARD
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // USERS
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    // PENGAJUAN
    Route::get('/pengajuan', [AdminPengajuanController::class, 'index'])->name('pengajuan.index');
    Route::put('/pengajuan/{id}/status', [AdminPengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    // ✅ NOTIFIKASI - semua dikumpulkan di sini
    Route::get('/notifikasi/{id}/baca', [AdminPengajuanController::class, 'bacaNotifikasi'])->name('notifikasi.baca');
    Route::post('/notifikasi/read-all', function () {
        \App\Models\Pengajuan::where('dibaca_admin', false)
            ->update(['dibaca_admin' => true]);
        return response()->json(['success' => true]);
    })->name('notifikasi.readAll');

    Route::prefix('iuk')->name('iuk.')->group(function () {

    Route::get('/', [LayananController::class, 'adminIndex'])->name('index');

    Route::get('/create', [LayananController::class, 'create'])->name('create');

    Route::post('/store', [LayananController::class, 'store'])->name('store');

    Route::get('/{id}/edit', [LayananController::class, 'edit'])->name('edit');

    Route::put('/{id}', [LayananController::class, 'update'])->name('update');

    Route::delete('/{id}', [LayananController::class, 'destroy'])->name('destroy');
});
    Route::prefix('perizinan')->name('perizinan.')->group(function () {

    Route::get('/', [PerizinanController::class, 'adminIndex'])
        ->name('index');

    Route::get('/create', [PerizinanController::class, 'createAdmin'])
        ->name('create');

    Route::post('/store', [PerizinanController::class, 'storeAdmin'])
        ->name('store');

    Route::get('/{id}/edit', [PerizinanController::class, 'editAdmin'])
        ->name('edit');

    Route::put('/{id}', [PerizinanController::class, 'updateAdmin'])
        ->name('update');

    Route::delete('/{id}', [PerizinanController::class, 'destroyAdmin'])
        ->name('destroy');
});

Route::get('/perizinan/{id}', [PerizinanController::class, 'show'])
    ->name('perizinan.show');
    /*
    |------------------------------------------
    | RESET PASSWORD ADMIN
    |------------------------------------------
    */
    Route::get('/password/forgot', [AdminLoginController::class, 'showForgotForm'])->name('password.request');
    Route::post('/password/email', [AdminLoginController::class, 'sendResetLink'])->name('password.email');
    Route::get('/password/reset/{token}', [AdminLoginController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [AdminLoginController::class, 'resetPassword'])->name('password.update');

    /*
    |------------------------------------------
    | PROFILE ADMIN
    |------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [AdminController::class, 'editProfile'])->name('edit');
        Route::post('/update', [AdminController::class, 'updateProfile'])->name('update');
        Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('password.form');
        Route::post('/change-password', [AdminController::class, 'updatePassword'])->name('password.update');
    });

    /*
    |------------------------------------------
    | CRUD LAYANAN (ADMIN)
    |------------------------------------------
    */
    Route::get('/layanan/create', [LayananController::class, 'create'])->name('layanan.create');
    Route::post('/layanan/store', [LayananController::class, 'store'])->name('layanan.store');
    Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

    /*
    |------------------------------------------
    | IUK (CRUD FIX)
    |------------------------------------------
    */
    




});