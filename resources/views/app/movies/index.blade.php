@extends('app.layouts.template')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-6 ">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">🎬 Meus Filmes</h1>

        {{-- Filtros e ordenação --}}
        <form method="GET" action="{{ route('movies.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-gray-50 p-4 rounded shadow mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Ano</label>
                <input
                    type="number"
                    name="year"
                    value="{{ request('year') }}"
                    placeholder="ex: 2023"
                    class="mt-1 w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select
                    name="watched"
                    class="mt-1 w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2"
                >
                    <option value="">-- Ambos --</option>
                    <option value="1" {{ request('watched') === '1' ? 'selected' : '' }}>Assistido</option>
                    <option value="0" {{ request('watched') === '0' ? 'selected' : '' }}>Não assistido</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ordenar por nota</label>
                <select
                    name="sort"
                    class="mt-1 w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2"
                >
                    <option value="">Padrão (Título ASC)</option>
                    <option value="rating_desc" {{ request('sort') === 'rating_desc' ? 'selected' : '' }}>Maior para menor</option>
                    <option value="rating_asc" {{ request('sort') === 'rating_asc' ? 'selected' : '' }}>Menor para maior</option>
                </select>
            </div>

            <div class="flex items-end">
                <button
                    type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition cursor-pointer"
                >
                    Filtrar
                </button>
            </div>
        </form>

        {{-- Tabela de filmes --}}
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-indigo-100 text-gray-900 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Título</th>
                        <th class="px-6 py-3">Ano</th>
                        <th class="px-6 py-3">Nota</th>
                        <th class="px-6 py-3">Assistido</th>
                        <th class="px-6 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($movies as $movie)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium">{{ $movie->title }}</td>
                            <td class="px-6 py-4">{{ $movie->year }}</td>
                            <td class="px-6 py-4">{{ $movie->rating ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if ($movie->watched)
                                    <span class="text-green-600 font-semibold">Sim</span>
                                @else
                                    <span class="text-red-600 font-semibold">Não</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                                <a href="{{ route('movies.show', $movie) }}" class="text-blue-600 hover:underline">Ver</a>
                                <a href="{{ route('movies.edit', $movie) }}" class="text-yellow-600 hover:underline">Editar</a>
                                
                                <form
                                    method="POST"
                                    action="{{ route('movies.destroy', $movie) }}"
                                    class="inline"
                                    onsubmit="return confirm('Deseja realmente excluir?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                </form>

                                <a href="{{ route('movies.toggleWatched', $movie) }}" class="text-purple-600 hover:underline">
                                    {{ $movie->watched ? 'Desmarcar' : 'Marcar' }} assistido
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Nenhum filme encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        <div class="mt-6">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
