<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/profil-kelas', 'profil-kelas')->name('profil-kelas');

Route::get('/bantuan', function () {
    $nama = 'Mulia Hamdan Bakti';
    $nim = '2511028';
    $prodi = 'Teknologi Rekayasa Internet';
    $tujuan = 'Belajar laravel untuk membuat katalog buku';
    return view('bantuan', compact('nama', 'nim', 'prodi', 'tujuan'));
})->name('bantuan');

Route::resource('books', BookController::class);
Route::resource('films', FilmController::class);