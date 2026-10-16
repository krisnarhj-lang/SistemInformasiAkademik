<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth Routes
Auth::routes();

// Route Halaman Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// Master Data Kelas
Route::resource('kelas', KelasController::class);

// Master Data Siswa
Route::resource('siswa', SiswaController::class);

// Master Data Guru
Route::resource('guru', GuruController::class);

// Master Data Mata Pelajaran (Mapel)
Route::resource('mapel', MapelController::class);

// Data Nilai Akademik
Route::resource('nilai', NilaiController::class);
