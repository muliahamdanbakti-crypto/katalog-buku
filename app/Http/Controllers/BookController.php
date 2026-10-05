<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->query('q', ''));
        $perPage = (int) $request->query('per_page', 10);

        if ($perPage < 1) {
            $perPage = 10;
        } elseif ($perPage > 999) {
            $perPage = 999;
        }

        $books = Book::query()
            ->when($keyword !== '', function ($query) use ($keyword): void {
                $query->where(function ($subQuery) use ($keyword): void {
                    $subQuery
                        ->where('title', 'like', "%{$keyword}%")
                        ->orWhere('author', 'like', "%{$keyword}%")
                        ->orWhere('isbn', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('title', 'asc')
            ->paginate($perPage)
            ->withQueryString();
            
        return view('books.index', compact('books','keyword'));
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function store(StoreBookRequest $request): RedirectResponse
    {
        Book::create($request->validated());
        return redirect()->route('books.index')->with('success', 'Data Buku berhasil ditambahkan.');
    }

    public function show(string $id): View
    {
        $book = Book::query()->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function edit(string $id): View
    {
        $book = Book::query()->findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, string $id): RedirectResponse
    {
        $book = Book::query()->findOrFail($id);
        $book->update($request->validated());
        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $book = Book::query()->findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Data buku berhasil dihapus.');
    }
}