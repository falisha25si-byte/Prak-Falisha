<?php
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
    return 'Nama saya: '.$param1;
});

Route::get('{param1}/{param2}/Annisa', function () {
    return 'Halo Falisha'.$param1;
});

Route::get('{param1}/nama', function ($param1) {
    if($param1 == 'Falisha')
        return 'Mahrin';
    else
        return 'Nama saya: '.$param1;
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

Route::get('/home',[HomeController::class,'index']);

Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');
