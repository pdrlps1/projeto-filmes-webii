@extends('app.layouts.template')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Detalhes do Filme</h1>

    <div class="bg-white p-6 rounded shadow mb-6">
        <p><strong>Título:</strong> {{ $movie->title }}</p>
        <p><strong>Ano:</strong> {{ $movie->year }}</p>
        <p><strong>Nota:</strong> {{ $movie->rating ?? '-' }}</p>
        <p><strong>Review:</strong> {{ $movie->review ?? 'Nenhum' }}</p>
        <p><strong>Assistido:</strong>
            @if ($movie->watched)
                <span class="text-green-600">Sim</span>
            @else
                <span class="text-red-600">Não</span>
            @endif
        </p>
    </div>

    <a href="{{ route('movies.edit', $movie) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>

    <form method="POST" action="{{ route('movies.destroy', $movie) }}" class="inline ml-2"
        onsubmit="return confirm('Deseja realmente excluir este filme?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Excluir</button>
    </form>

    <a href="{{ route('movies.index') }}" class="ml-2 text-gray-600 hover:underline">Voltar</a>
@endsection
