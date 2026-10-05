@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')
<h1>Data Buku</h1>

<form method="GET" action="{{ route('books.index') }}" style="margin-bottom:10px;">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul buku..." style="padding:5px; width:200px;">
  <select name="per_page" style="padding:5px;">
    @foreach([5, 10, 25, 50, 100] as $option)
      <option value="{{ $option }}" @selected((int) request('per_page', 10) === $option)>{{ $option }}</option>
    @endforeach
  </select>
  <button type="submit" style="padding:5px;">Cari</button>
  <a href="{{ route('books.index') }}" style="padding:5px;">Reset</a>
</form>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Judul</th>
      <th>Penulis</th>
      <th>Stok</th>
      <th>Dibuat</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($books as $book)
      <tr>
        <td>{{ $books->firstItem() + $loop->index }}</td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>

        <td>
          @if($book->stock == 0)
            <span style="color:white; background:red; padding:3px 8px; border-radius:4px; font-weight:bold;">Stok Habis</span>
          @else
            {{ $book->stock }}
          @endif
        </td>

        <td>{{ $book->created_at?->format('d/m/Y') ?? '-' }}</td>

        <td>
          <a href="{{ route('books.show', $book->id) }}">Detail</a> |
          <a href="{{ route('books.edit', $book->id) }}">Edit</a>

          <form method="POST" action="{{ route('books.destroy', $book->id) }}" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
              @csrf
              @method('DELETE')
              <button type="submit">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5" align="center">Data belum tersedia</td>
      </tr>
    @endforelse
  </tbody>
</table>

<div style="margin-top:20px;">
  {{ $books->links() }}
</div>

@if ($books->hasPages())
<div style="margin-top:10px;">
  @if ($books->onFirstPage())
    <span>Sebelumnya</span>
  @else
    <a href="{{ $books->previousPageUrl() }}">Sebelumnya</a>
  @endif

  Halaman {{ $books->currentPage() }} dari {{ $books->lastPage() }}

  @if ($books->hasMorePages())
    <a href="{{ $books->nextPageUrl() }}">Berikutnya</a>
  @endif
</div>
@endif
@endsection