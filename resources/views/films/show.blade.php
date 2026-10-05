@extends('layouts.app')

@section('title', 'Detail Film')

@section('content')
    <a href="{{ route('films.index') }}" style="text-decoration:none;">&larr; Kembali ke Daftar Film</a>

    <h1 style="margin-top:15px;">{{ $film['title'] ?? 'Detail Film' }} ({{ $film['release_year'] ?? '-' }})</h1>
    
    <div style="margin-top:10px; line-height:1.6;">
        <p><strong>Tahun Rilis:</strong> {{ $film['release_year'] ?? '-' }}</p>
        <p><strong>Sutradara:</strong> {{ $film['director'] ?? '-' }}</p>
        <p><strong>Deskripsi:</strong><br> {{ $film['desc'] ?? 'Tidak ada deskripsi' }}</p>
    </div>

    <hr style="margin:20px 0;">

    <p><strong>ID Film:</strong> {{ $film['id'] }}</p>
@endsection