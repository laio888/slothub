<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Leanny Alzate Cosmetología')</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='45' fill='%23c9a84c'/><text y='.9em' font-size='60' x='50%' text-anchor='middle' fill='white' dy='5'>✦</text></svg>"/>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="/css/styles.css"/>
    @stack('styles')
</head>
<body>

<nav>
    <a class="nav-brand" href="/">
        <div class="nav-logo">✦</div>
        <span class="nav-brand-text">Leanny Alzate Cosmetología</span>
    </a>

    <button class="hamburger" id="hamburger" aria-label="Menú">
        <span></span><span></span><span></span>
    </button>

    <ul class="nav-links" id="navLinks">
        <!-- Links públicos -->
        <li class="nav-public"><a href="/"          class="{{ request()->is('/') ? 'active' : '' }}">Inicio</a></li>
        <li class="nav-public"><a href="/servicios" class="{{ request()->is('servicios') ? 'active' : '' }}">Servicios</a></li>

        <!-- Links solo para NO logueados -->
        <li class="nav-guest"><a href="/registro"   class="{{ request()->is('registro') ? 'active' : '' }}">Registro</a></li>
        <li class="nav-guest"><a href="/login"       class="{{ request()->is('login') ? 'active' : '' }}">Login</a></li>

        <!-- Links solo para logueados -->
        <li class="nav-auth"><a href="/dashboard"   class="{{ request()->is('dashboard') ? 'active' : '' }}">Mi Panel</a></li>
        <li class="nav-auth"><a href="/agendar"     class="{{ request()->is('agendar') ? 'active' : '' }}">Agendar</a></li>
        <li class="nav-auth"><a href="/mis-citas"   class="{{ request()->is('mis-citas') ? 'active' : '' }}">Mis Citas</a></li>
        <li class="nav-auth">
            <a href="#" id="btnLogout" class="nav-logout">
                <span>Cerrar sesión</span>
            </a>
        </li>

        <!-- Avatar del usuario logueado -->
        <li class="nav-auth nav-avatar-item">
            <div class="nav-avatar" id="navAvatar">U</div>
        </li>
    </ul>
</nav>

@yield('content')

<footer>© 2025 Leanny Alzate Cosmetología &mdash; Todos los derechos reservados</footer>

<script type="module" src="/js/nav.js"></script>
@stack('scripts')
</body>
</html>
