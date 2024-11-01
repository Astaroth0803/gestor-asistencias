<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Gestor de Asistencias')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <ul class="navbar-menu">
            <li><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li><a href="{{ route('asistencias.index') }}">Asistencias</a></li>
            <li><a href="{{ route('actividades.index') }}">Actividades</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="nav-logout-form">
                    @csrf
                    <button type="submit" class="btn-logout">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script type="module" src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
