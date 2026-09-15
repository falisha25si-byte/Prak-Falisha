<?php


Route::get('/', function () {
    return view('welcome');
});

Route ::get('/pcr', function() {
    return 'selamat datang di website kampus PCR';
});

Route ::get('/falisha', function() {
    return 'halo falisha';
});

Route ::get('{param1}/{param2}/falisha',function(){
    return 'halo falisha';
});

Route ::get('/{param1}/nama/',function ($param1) {
    return 'halo falisha';
});

Route::get('/mahasiswa/{param1}',
[MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

use App\Http\Controllers\MatakuliahController;

Route::get('/matakuliah', [MatakuliahController::class, 'index']);

Route::get('/matakuliah/create', [MatakuliahController::class, 'create']);

Route::post('/matakuliah', [MatakuliahController::class, 'store']);

Route::get('/matakuliah/show/{kode?}', [MatakuliahController::class, 'show']);

Route::get('/matakuliah/edit/{kode}', [MatakuliahController::class, 'edit']);

Route::put('/matakuliah/{kode}', [MatakuliahController::class, 'update']);

Route::delete('/matakuliah/{kode}', [MatakuliahController::class, 'destroy']);
