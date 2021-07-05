<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('layouts.beranda');
});

Route::get('/beranda', function () {
    return view('layouts.beranda');
});

Route::get('/about', function () {
    return view('layouts.about');
});

Route::get('/salam', function () {
    return "Assalaamu'alaikum Temen-Temen 4TI03";
});

Route::get('/pegawai/{nama}/{divisi}', function ($nama, $divisi) {
    return 'Nama Pegawai : '.$nama.'<br/>Departemen : '.$divisi;
});

Route::get('/kabar', function () {
    return view('kondisi');
});

Route::get('/nilai', function () {
    return view('nilai');
});

Route::get('/daftarnilai', function () {
    return view('daftar_nilai');
});

Route::get('/pengarang', [PengarangController::class, 'index']
);

Route::get('/penerbit', [PenerbitController::class, 'index']
);

Route::get('/kategori', [KategoriController::class, 'index']
);

Route::get('/buku', [BukuController::class, 'index']
);

route::resource('/pengarang', PengarangController::class);
route::resource('/penerbit', PenerbitController::class);
route::resource('/kategori', KategoriController::class);
route::resource('/buku', BukuController::class);
route::get('generate-pdf', [BukuController::class, 'generatePDF']);
route::get('buku-pdf', [BukuController::class, 'bukuPDF']);