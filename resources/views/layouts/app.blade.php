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
    <a class="nav-brand" href="{{ route('inicio') }}">
        <div class="nav-logo">✦</div>
        <span class="nav-brand-text">Leanny Alzate Cosmetología</span>
    </a>

    <button class="hamburger" id="hamburger" aria-label="Menú">
        <span></span><span></span><span></span>
    </button>

    <ul class="nav-links" id="navLinks">

        {{-- Siempre visibles --}}
        <li>
            <a href="{{ route('inicio') }}"
               class="{{ request()->routeIs('inicio') ? 'active' : '' }}">Inicio</a>
        </li>
        <li>
            <a href="{{ route('servicios') }}"
               class="{{ request()->routeIs('servicios') ? 'active' : '' }}">Servicios</a>
        </li>

        {{-- Sin sesión --}}
        @guest('web')
            <li>
                <a href="{{ route('registro') }}"
                   class="{{ request()->routeIs('registro') ? 'active' : '' }}">Registro</a>
            </li>
            <li>
                <a href="{{ route('login') }}"
                   class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
            </li>
        @endguest

        {{-- Con sesión de cliente --}}
        @if(session('cliente_id'))
            <li>
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Mi Panel</a>
            </li>
            <li>
                <a href="{{ route('agendar') }}"
                   class="{{ request()->routeIs('agendar') ? 'active' : '' }}">Agendar</a>
            </li>
            <li>
                <a href="{{ route('mis-citas') }}"
                   class="{{ request()->routeIs('mis-citas') ? 'active' : '' }}">Mis Citas</a>
            </li>

            {{-- Link al admin solo si es admin --}}
            @if(session('cliente_rol') === 'admin')
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="nav-admin-link">⚙️ Admin</a>
                </li>
            @endif

            <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-logout-btn">Cerrar sesión</button>
                </form>
            </li>
            <li>
                <div class="nav-avatar">
                    {{ strtoupper(substr(session('cliente_nombres'), 0, 1)) }}
                </div>
            </li>
        @endif

    </ul>
</nav>

{{-- Flash messages --}}
@if(session('success'))
    <div class="flash-msg flash-success">✅ {{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="flash-msg flash-error">⚠️ {{ session('error') }}</div>
@endif

@yield('content')

<footer>© 2025 Leanny Alzate Cosmetología &mdash; Todos los derechos reservados</footer>

<script>
    document.getElementById('hamburger')?.addEventListener('click', () => {
        document.getElementById('navLinks')?.classList.toggle('open');
    });

    // Ocultar flash messages después de 4 segundos
    setTimeout(() => {
        document.querySelectorAll('.flash-msg').forEach(el => {
            el.style.transition = 'opacity .5s';
            el.style.opacity    = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 4000);
</script>

@stack('scripts')
</body>
</html>
