<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');

});
Route::view('/profil-kelas', 'profil-kelas')
    ->name('profil-kelas');