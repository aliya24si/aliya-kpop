<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/pegawai', [PegawaiController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    $a = 5 + 5;
    return 'Selamat Datang di Website Kampus PCR!' . $a;
});

Route::get('/mahasiswa/{param1?}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: ' . $param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: ' . $param1;
});

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home', [HomeController::class, 'index']);

Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');

//Route::get('dashboard', [DashboardController::class, 'index'])
//	->name('dashboard');

Route::resource('login', LoginController::class)->only(['index', 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Dashboard tanpa middleware
Route::get('/dashboard', function () {return view('admin.dashboard');})
    ->name('dashboard')
    ->middleware('checkislogin');

Route::resource('pelanggan', PelangganController::class); //untuk memanggil semua function sekaligus
Route::post('/pelanggan/upload-files', [PelangganController::class, 'uploadFiles'])
    ->name('pelanggan.uploadFiles');
Route::delete('/pelanggan/file/{id}',
    [PelangganController::class, 'deleteFile']
)->name('pelanggan.file.delete');


Route::group(['middleware'=>['checkrole:admin']],function(){
		Route::resource('user', UserController::class);
});

//Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
