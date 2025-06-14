<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
    @vite('resources/css/app.css')
</head>

<body>
    @include('app.components.navbar')

    <div class="w-full mt-5">
        @yield('content')
    </div>

    @include('app.components.footer')

</body>

</html>
