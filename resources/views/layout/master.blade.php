<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Aplicacion Laravel</h1>
        <nav>
            <a href="#" class="btn btn-primary px-3 py-2 fw-semibold">Inicio</a>
            <a href="#" class="btn btn-secondary px-3 py-2 fw-semibold">Perfil</a>
            <a href="#" class="btn btn-danger px-3 py-2 fw-semibold">Salir</a>
        </nav>
    </div>
</header>

<main class="container mx-auto mt-6">
    @yield('content')
</main>

<footer class="bg-white text-center text-sm text-gray-500 py-4 mt-10 border-t">
    © {{ date('Y') }} Alan Altamirano. Todos los derechos reservados.
</footer>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="{{asset("js/Posts.js")}}"></script>
</body>
</html>
