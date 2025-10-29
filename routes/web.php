<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;


Route::match(['get','post'],'/pegawai',[PegawaiController::class,'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    $a = 5 + 5;
    return 'Selamat Datang di Website Kampus PCR!'.$a;
});

Route::get('/mahasiswa/{param1?}',[MahasiswaController::class, 'show'])->name('mahasiswa.show');

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: '.$param1;
});

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home', [HomeController::class,'index']);

Route::post('question/store', [QuestionController::class, 'store'])
	->name('question.store');

//Route::get('dashboard', [DashboardController::class, 'index'])
//	->name('dashboard');

Route::resource('login', LoginController::class)->only(['index', 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard tanpa middleware
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');


Route::resource('pelanggan', PelangganController::class); //untuk memanggil semua function sekaligus

Route::resource('user', UserController::class);

//Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

