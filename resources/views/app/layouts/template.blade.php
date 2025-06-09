<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>

    {{-- Bootstrap CSS via CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-…" crossorigin="anonymous">
</head>

<body>
    @include('app.components.navbar')

    <div class="container mt-5">
        @yield('content')
    </div>

    {{-- Bootstrap JS via CDN (bundle com Popper) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-…"
        crossorigin="anonymous"></script>

    @include('app.components.footer')

</body>

</html>
