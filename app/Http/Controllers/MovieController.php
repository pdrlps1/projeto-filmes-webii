<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Exibe lista com possibilidade de filtro e ordenação.
     */
    public function index(Request $request)
    {
        // 1. Filtro por ano ou status (watched)
        $query = Movie::query();

        if ($request->filled('year')) {
            $query->where('year', $request->input('year'));
        }

        if ($request->filled('watched')) {
            // watched pode ser '0' ou '1'
            $query->where('watched', $request->input('watched'));
        }

        // 2. Ordenação por nota (rating)
        if ($request->input('sort') === 'rating_desc') {
            $query->orderBy('rating', 'desc');
        } elseif ($request->input('sort') === 'rating_asc') {
            $query->orderBy('rating', 'asc');
        } else {
            $query->orderBy('title', 'asc'); // padrão
        }

        $movies = $query->paginate(10)->withQueryString();

        return view('app.movies.index', compact('movies'));
    }

    /**
     * Exibe formulário de criação.
     */
    public function create()
    {
        return view('app.movies.create');
    }

    /**
     * Armazena um novo registro.
     */
    public function store(MovieRequest $request)
    {
        Movie::create($request->validated());

        return redirect()->route('movies.index')
                         ->with('success', 'Filme cadastrado com sucesso.');
    }

    /**
     * Exibe detalhes de um filme.
     */
    public function show(Movie $movie)
    {
        return view('app.movies.show', compact('movie'));
    }

    /**
     * Exibe formulário de edição.
     */
    public function edit(Movie $movie)
    {
        return view('app.movies.edit', compact('movie'));
    }

    /**
     * Atualiza registro existente.
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());

        return redirect()->route('movies.index')
                         ->with('success', 'Informações do filme atualizadas.');
    }

    /**
     * Remove um filme.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')
                         ->with('success', 'Filme excluído com sucesso.');
    }

    /**
     * Marca/desmarca como assistido via request AJAX (opcional).
     * Se não for usar AJAX, basta usar update no próprio form de edição.
     */
    public function toggleWatched(Movie $movie)
    {
        $movie->watched = ! $movie->watched;
        $movie->save();

        return redirect()->route('movies.index')
                         ->with('success', 'Status de assistido alterado.');
    }
}
