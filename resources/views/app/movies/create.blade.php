@extends('app.layouts.template')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Adicionar Filme</h1>

    <form method="POST" action="{{ route('movies.store') }}" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="title" class="block font-medium">Título:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="w-full border px-2 py-1 rounded">
            @error('title')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="year" class="block font-medium">Ano:</label>
            <input type="number" name="year" id="year" value="{{ old('year') }}"
                class="w-full border px-2 py-1 rounded">
            @error('year')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="rating" class="block font-medium">Nota (0–10):</label>
            <input type="number" step="0.1" name="rating" id="rating" value="{{ old('rating') }}"
                class="w-full border px-2 py-1 rounded">
            @error('rating')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="review" class="block font-medium">Review:</label>
            <textarea name="review" id="review" rows="4" class="w-full border px-2 py-1 rounded">{{ old('review') }}</textarea>
            @error('review')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="watched" class="inline-flex items-center">
                <input type="checkbox" name="watched" id="watched" value="1" {{ old('watched') ? 'checked' : '' }}
                    class="mr-2">
                Assistido
            </label>
            @error('watched')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded cursor-pointer">
            Salvar Filme
        </button>
        <a href="{{ route('movies.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
    </form>
@endsection
