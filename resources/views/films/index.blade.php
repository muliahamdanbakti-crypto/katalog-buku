@extends('layouts.app')

@section('title', 'Data Film')

@section('content')

    {{-- Notif sukses dari store() --}}
    @if(session('success'))
        <div style="background:#dcfce7; color:#166534; padding:10px; border-radius:6px; margin-bottom:12px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('films.create') }}" style="display:inline-block; margin-bottom:12px; padding:8px 12px; background:#2563eb; color:white; text-decoration:none; border-radius:6px;">
        + Tambah Film
    </a>

    <h1>Data Film</h1>
    
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($films as $film)
                <tr>
                    <td>{{ $film['id'] }}</td>
                    <td>{{ $film['title'] ?? '-' }}</td>
                    <td>{{ $film['release_year'] ?? '-' }}</td>
                    <td>
                        {{-- INI YANG BENER PAP, JANGAN HARDCODE 1 --}}
                        <a href="{{ route('films.show', $film['id']) }}">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" align="center">Belum ada data film</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection