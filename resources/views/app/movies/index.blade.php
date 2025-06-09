@extends('app.layouts.template')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Meus Filmes</h1>

    {{-- Filtros e ordenação --}}
    <form method="GET" action="{{ route('movies.index') }}" class="flex space-x-4 mb-6">
        <div>
            <label>Ano:</label>
            <input type="number" name="year" value="{{ request('year') }}" class="border px-2 py-1 rounded"
                placeholder="ex: 2023">
        </div>
        <div>
            <label>Status:</label>
            <select name="watched" class="border px-2 py-1 rounded">
                <option value="">-- Ambos --</option>
                <option value="1" {{ request('watched') === '1' ? 'selected' : '' }}>Assistido</option>
                <option value="0" {{ request('watched') === '0' ? 'selected' : '' }}>Não assistido</option>
            </select>
        </div>
        <div>
            <label>Ordenar por nota:</label>
            <select name="sort" class="border px-2 py-1 rounded">
                <option value="">Padrão (Título ASC)</option>
                <option value="rating_desc" {{ request('sort') === 'rating_desc' ? 'selected' : '' }}>Maior para menor
                </option>
                <option value="rating_asc" {{ request('sort') === 'rating_asc' ? 'selected' : '' }}>Menor para maior</option>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="bg-gray-600 text-white px-3 py-1 rounded">Filtrar</button>
        </div>
    </form>

    {{-- Tabela de filmes --}}
    <table class="w-full table-auto bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Título</th>
                <th class="px-4 py-2">Ano</th>
                <th class="px-4 py-2">Nota</th>
                <th class="px-4 py-2">Assistido</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movies as $movie)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $movie->title }}</td>
                    <td class="px-4 py-2">{{ $movie->year }}</td>
                    <td class="px-4 py-2">{{ $movie->rating ?? '-' }}</td>
                    <td class="px-4 py-2">
                        @if ($movie->watched)
                            <span class="text-green-600 font-semibold">Sim</span>
                        @else
                            <span class="text-red-600 font-semibold">Não</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('movies.show', $movie) }}" class="text-blue-500 hover:underline">Ver</a>
                        <a href="{{ route('movies.edit', $movie) }}" class="text-yellow-500 hover:underline">Editar</a>
                        <form method="POST" action="{{ route('movies.destroy', $movie) }}" class="inline"
                            onsubmit="return confirm('Deseja realmente excluir?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                        </form>
                        {{-- Botão para marcar/desmarcar assistido --}}
                        <a href="{{ route('movies.toggleWatched', $movie) }}" class="text-purple-600 hover:underline">
                            {{ $movie->watched ? 'Desmarcar' : 'Marcar' }} assistido
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center">Nenhum filme encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginação --}}
    <div class="mt-4">
        {{ $movies->links() }}
    </div>
@endsection
