@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h1>Tambah Buku</h1>

    <form method="POST" action="{{ route('books.store') }}">
        @csrf

        <div>
            <label for="title">Judul</label>
            <input id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="isbn">ISBN</label>
            <input id="isbn" name="isbn" value="{{ old('isbn') }}">
            @error('isbn')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="author">Penulis</label>
            <input id="author" name="author" value="{{ old('author') }}">
            @error('author')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="publisher">Penerbit</label>
            <input id="publisher" name="publisher" value="{{ old('publisher') }}">
            @error('publisher')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="published_year">Tahun Terbit</label>
            <input id="published_year" name="published_year" type="number" value="{{ old('published_year') }}">
            @error('published_year')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="price">Harga</label>
            <input id="price" name="price" type="number" step="0.01" value="{{ old('price') }}">
            @error('price')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="stock">Stok</label>
            <input id="stock" name="stock" type="number" value="{{ old('stock') }}">
            @error('stock')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection