<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Tu Nombre - Cosmetología')</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='45' fill='%23c9a84c'/><text y='.9em' font-size='60' x='50%' text-anchor='middle' fill='white' dy='5'>✦</text></svg>"/>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<nav>
    <a class="nav-brand" href="/">
        <div class="nav-logo">✦</div>
        <span class="nav-brand-text">Tu Nombre - Cosmetología</span>
    </a>

    <button class="hamburger" id="hamburger" aria-label="Menú">
        <span></span><span></span><span></span>
    </button>

    <ul class="nav-links" id="navLinks">
        <li><a href="/"          class="{{ request()->is('/') ? 'active' : '' }}">Inicio</a></li>
        <li><a href="/servicios" class="{{ request()->is('servicios') ? 'active' : '' }}">Servicios</a></li>
        <li><a href="/agendar"   class="{{ request()->is('agendar') ? 'active' : '' }}">Agendar</a></li>
        <li><a href="/login"     class="{{ request()->is('login') ? 'active' : '' }}">Login</a></li>
    </ul>
</nav>

@yield('content')

<footer>© 2025 Tu Nombre - Cosmetología — Todos los derechos reservados</footer>

<script src="{{ asset('js/nav.js') }}"></script>

@stack('scripts')

</body>
</html>
