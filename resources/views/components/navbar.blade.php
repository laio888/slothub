<header class="navbar" id="navbar">
    <div class="nav-inner">

        <a href="{{ route('home') }}" class="logo">
            <span class="logo-icon">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <rect width="32" height="32" rx="8" fill="#00E5A0"/>
                    <path d="M8 16C8 11.582 11.582 8 16 8s8 3.582 8 8-3.582 8-8 8-8-3.582-8-8z"
                          stroke="#0A0F1E" stroke-width="2" fill="none"/>
                    <path d="M16 11v5l3 3" stroke="#0A0F1E" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            Slot<strong>Hub</strong>
        </a>

        <button class="hamburger" id="hamburger" aria-label="Abrir menú">
            <span></span><span></span><span></span>
        </button>

        <nav class="nav-links" id="navLinks">
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'active' : '' }}">
                Inicio
            </a>
            <a href="{{ route('servicios') }}"
               class="{{ request()->routeIs('servicios') ? 'active' : '' }}">
                Servicios
            </a>
            <a href="{{ route('como-funciona') }}"
               class="{{ request()->routeIs('como-funciona') ? 'active' : '' }}">
                ¿Cómo funciona?
            </a>
            <a href="{{ route('aliados') }}"
               class="{{ request()->routeIs('aliados') ? 'active' : '' }}">
                Para Aliados
            </a>
            <a href="{{ route('contacto') }}"
               class="{{ request()->routeIs('contacto') ? 'active' : '' }}">
                Contacto
            </a>
            <a href="{{ route('login') }}" class="btn-nav">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn-nav btn-primary-nav">Registrarse</a>
        </nav>

    </div>
</header>
