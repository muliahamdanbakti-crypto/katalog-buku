<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $books = Book::orderBy('title', 'asc')->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => [
                'nullable',
                'string',
                'max:20',
                'unique:books,isbn',
            ],
            'author' => ['required', 'string', 'max:150'],
            'publisher' => ['nullable', 'string', 'max:150'],
            'published_year' => [
                'nullable',
                'integer',
                'min:1900',
                'max:' . date('Y'),
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ], [
            'required' => 'Field :attribute wajib diisi.',
            'string' => 'Field :attribute harus berupa teks.',
            'max' => 'Field :attribute maksimal :max karakter.',
            'min' => 'Field :attribute minimal :min.',
            'numeric' => 'Field :attribute harus berupa angka.',
            'integer' => 'Field :attribute harus berupa bilangan bulat.',
            'unique' => 'Field :attribute sudah digunakan yang lain.',
            'title.required' => 'Judul buku wajib diisi.',
            'title.max' => 'Judul buku maksimal :max karakter.',
            'author.required' => 'Nama penulis wajib diisi.',
            'price.required' => 'Harga buku wajib diisi.',
            'stock.required' => 'Stok buku wajib diisi.',
            'published_year.min' => 'Tahun terbit minimal tahun 1990.',
            'published_year.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang ' . date('Y') . '.',
        ]);

        $book = Book::create($validated);

        return redirect()
        ->route('books.index')
        ->with('success', 'Data Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $book = Book::query()->findOrFail($id);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $book = Book::query()->findOrFail($id);

        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $book = Book::query()->findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => [
                'nullable',
                'string',
                'max:20',
                'unique:books,isbn,' . $book->id,
            ],
            'author' => ['required', 'string', 'max:150'],
            'publisher' => ['nullable', 'string', 'max:150'],
            'published_year' => [
                'nullable',
                'integer',
                'min:1900',
                'max:' . date('Y'),
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ], [
            'required' => 'Field :attribute wajib diisi.',
            'string' => 'Field :attribute harus berupa teks.',
            'max' => 'Field :attribute maksimal :max karakter.',
            'min' => 'Field :attribute minimal :min.',
            'numeric' => 'Field :attribute harus berupa angka.',
            'integer' => 'Field :attribute harus berupa bilangan bulat.',
            'unique' => 'Field :attribute sudah digunakan yang lain.',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $book = Book::query()->findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Data buku berhasil dihapus.');
    }
}
