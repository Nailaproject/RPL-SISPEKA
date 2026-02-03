<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeachingAssignmentController;

use App\Http\Controllers\Guru\AttendanceController;
use App\Http\Controllers\Guru\GradeController;
use App\Http\Controllers\Guru\BehaviorNoteController;
use App\Http\Controllers\Guru\LaporanSiswaController;

use App\Http\Controllers\Wali\WaliController;

use App\Http\Controllers\Authh\LoginController;
use App\Http\Controllers\Authh\RegisterController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class,'admin'])->name('dashboard');
    Route::resource('guru', GuruController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('teaching', TeachingAssignmentController::class);
});


/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('dashboard', [DashboardController::class,'guru'])->name('dashboard');
    Route::resource('attendance', AttendanceController::class);
    Route::resource('grade', GradeController::class);
    Route::resource('laporan', LaporanSiswaController::class);
});

/*
|--------------------------------------------------------------------------
| WALI
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:wali'])->prefix('wali')->name('wali.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'wali'])->name('dashboard');

    Route::get('attendance', [WaliController::class, 'attendance'])->name('attendance');
    Route::get('grade', [WaliController::class, 'grade'])->name('grade');
    Route::get('laporan', [WaliController::class, 'laporan'])->name('laporan');
});



