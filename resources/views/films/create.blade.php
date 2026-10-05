<form action="{{ route('films.store') }}" method="POST">
    @csrf

    <div style="margin-bottom:12px;">
        <label>Judul Film:</label><br>
        <input type="text" name="title" value="{{ old('title') }}" style="width:100%; padding:8px; border:1px solid {{ $errors->has('title') ? 'red' : '#ccc' }}; border-radius:4px;">
        @error('title')
            <div style="color:red; font-size:12px; margin-top:4px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom:12px;">
        <label>Tahun Rilis:</label><br>
        <input type="number" name="release_year" value="{{ old('release_year') }}" style="width:100%; padding:8px; border:1px solid {{ $errors->has('release_year') ? 'red' : '#ccc' }}; border-radius:4px;">
        @error('release_year')
            <div style="color:red; font-size:12px; margin-top:4px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom:12px;">
        <label>Sutradara:</label><br>
        <input type="text" name="director" value="{{ old('director') }}" style="width:100%; padding:8px; border:1px solid {{ $errors->has('director') ? 'red' : '#ccc' }}; border-radius:4px;">
        @error('director')
            <div style="color:red; font-size:12px; margin-top:4px;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" style="padding:8px 16px; background:#2563eb; color:white; border:none; border-radius:6px;">Simpan Film</button>
</form>