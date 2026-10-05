@extends('layouts.app')
@section('title', $book->title)

@section('content')
<a href="{{ route('books.index') }}">&larr; Kembali ke Daftar</a>

<h1 style="margin-top:15px;">Detail Buku</h1>
<h2>{{ $book->title }}</h2>
<p style="color:#64748b;">ISBN: {{ $book->isbn }} | Ditambahkan: {{ $book->created_at->format('d M Y') }}</p>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:20px;">

    <div style="border:1px solid #e2e8f0; padding:15px; border-radius:8px;">
        <h3>Informasi Buku</h3>
        <p><strong>Penulis:</strong> {{ $book->author }}</p>
        <p><strong>Penerbit:</strong> {{ $book->publisher ?? '-' }}</p>
        <p><strong>Tahun Terbit:</strong> {{ $book->published_year }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
        <p><strong>Deskripsi:</strong><br>{{ $book->description ?? 'Tidak ada deskripsi' }}</p>
    </div>

    <div style="border:1px solid #e2e8f0; padding:15px; border-radius:8px;">
        <h3>Stok & Lokasi</h3>
        <p><strong>Stok Saat Ini:</strong> 
            @if($book->stock == 0) 
                <span style="background:red; color:white; padding:2px 8px; border-radius:4px;">STOK HABIS</span>
            @else 
                {{ $book->stock }} eksemplar 
            @endif
        </p>
        <p><strong>Lokasi Rak:</strong> {{ $book->location ?? 'Belum diatur' }}</p>
        <p><strong>Status:</strong> {{ $book->stock > 0 ? 'Tersedia' : 'Tidak Tersedia' }}</p>

        <div style="margin-top:20px;">
            <a href="{{ route('books.edit', $book) }}" style="padding:8px 12px; background:#2563eb; color:white; text-decoration:none; border-radius:6px;">Edit Buku</a>
            
            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus buku ini?')">
                @csrf @method('DELETE')
                <button type="submit" style="padding:8px 12px; background:#ef4444; color:white; border:none; border-radius:6px; cursor:pointer;">Hapus</button>
            </form>
        </div>
    </div>

</div>
@endsection