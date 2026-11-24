<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/Annisa', function () {
    return 'Halo Falisha!';
});

Route::get('/Hobi', function () {
    return 'Hobi saya memasak!';
});

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: ' . $param1;
});

Route::get('{param1}/{param2}/Annisa', function () {
    return 'Halo Falisha' . $param1;
});

Route::get('{param1}/nama', function ($param1) {
    if ($param1 == 'Falisha') {
        return 'Mahrin';
    } else {
        return 'Nama saya: ' . $param1;
    }

});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/matakuliah', [MatakuliahController::class, 'index']);

Route::get('/matakuliah/show/{id?}', [MatakuliahController::class, 'show']);

Route::get('/matakuliah/create', [MatakuliahController::class, 'create']);

Route::post('/matakuliah', [MatakuliahController::class, 'store']);

Route::get('/matakuliah/edit/{id}', [MatakuliahController::class, 'edit']);

Route::put('/matakuliah/{id}', [MatakuliahController::class, 'update']);

Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy']);

Route::get('/home', [HomeController::class, 'index']);

Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');

Route::resource('pelanggan', PelangganController::class);

Route::resource('user', UserController::class);

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['checkrole:Super Admin'])->group(function () {
        Route::resource('user', UserController::class);
    });

    Route::middleware(['checkrole:Super Admin,mitra'])->group(function () {
        Route::resource('pelanggan', PelangganController::class);
    });
});

Route::get('/auth/redirect-google', [AuthController::class, 'redirectToGoogle'])
    ->name('redirect.google');

Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback'])
    ->name('google.callback');
