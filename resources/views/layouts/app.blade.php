<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog Buku')</title>
</head>
<body>
    <nav style="margin-bottom:15px;">
        <a href="{{ route('books.index') }}">Data Buku</a> |
        <a href="{{ route('books.create') }}">Tambah Buku</a> |
        <a href="{{ route('bantuan') }}">Bantuan</a>
    </nav>
    <hr>
    <main>

    @if (session('success'))
    <div class="alert success">
        {{ session('success') }}
    </div>
    @endif

        @yield('content')
    </main>
</body>
</html>
