@extends('layouts.app')

@section('content')
<div style="padding:20px; max-width:800px; margin:auto; background:#f9f9f9; border-radius:10px;">
    <h2>Data Mahasiswa</h2>
    <table>
        <tr><td>Nama</td><td>: Mulia Hamdan Bakti</td></tr>
        <tr><td>NIM</td><td>: 2511028</td></tr>
        <tr><td>Program Studi</td><td>: Teknologi Rekayasa Internet</td></tr>
        <tr><td>Tujuan Belajar</td><td>: Belajar Laravel untuk membuat katalog buku</td></tr>
    </table>

    <hr style="margin:20px 0;">

    <h2>Bantuan / Panduan Aplikasi Katalog Buku</h2>
    <p>Aplikasi ini dibuat untuk mengelola data buku perpustakaan sederhana menggunakan Laravel.</p>
    
    <h3>Fitur Aplikasi:</h3>
    <ol>
        <li><b>Data Buku:</b> Menampilkan semua data buku yang ada di database. Dilengkapi fitur Search (cari judul, penulis, ISBN) dan Pagination.</li>
        <li><b>Tambah Buku:</b> Klik menu "Tambah Buku" untuk menambah data baru. Isi Judul, Penulis, ISBN, Tahun Terbit, dan Stok.</li>
        <li><b>Edit Buku:</b> Pada halaman Data Buku, klik tombol "Edit" untuk mengubah data buku.</li>
        <li><b>Hapus Buku:</b> Pada halaman Data Buku, klik tombol "Hapus" untuk menghapus data buku.</li>
    </ol>

    <h3>Cara Menjalankan:</h3>
    <code>php artisan serve</code> <br>
    Lalu buka <code>http://127.0.0.1:8000/books</code>
</div>
@endsection