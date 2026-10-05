<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FilmController extends Controller
{
    private function getFilms(): array
    {
        return session('films', [
            ['id' => 1, 'title' => 'Naruto', 'release_year' => 2024, 'desc' => 'Film anime terbaik'],
            ['id' => 2, 'title' => 'One Piece', 'release_year' => 2023, 'desc' => 'Petualangan bajak laut'],
        ]);
    }

    public function index(): View
    {
        $films = $this->getFilms();

        return view('films.index', compact('films'));
    }

    public function create(): View
    {
        return view('films.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'release_year' => ['required', 'numeric', 'min:1900', 'max:2030'],
        ]);

        $films = $this->getFilms();

        $films[] = [
            'id' => count($films) + 1,
            'title' => $request->title,
            'release_year' => $request->release_year,
            'desc' => 'Film baru ditambahkan',
        ];

        session(['films' => $films]);

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambah!');
    }

    public function show(string $id): View
    {
        $films = $this->getFilms();

        $film = collect($films)->firstWhere('id', (int) $id);

        if (! $film) {
            abort(404, 'Film tidak ditemukan');
        }

        return view('films.show', compact('film'));
    }
}