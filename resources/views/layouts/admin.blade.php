<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Admin – Leanny Alzate')</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='45' fill='%23c9a84c'/><text y='.9em' font-size='60' x='50%' text-anchor='middle' fill='white' dy='5'>✦</text></svg>"/>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="/css/styles.css"/>
    <link rel="stylesheet" href="/css/admin.css"/>
    @stack('styles')
</head>
<body class="admin-body">

<div class="admin-layout">

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <span class="sidebar-logo">✦</span>
            <span class="sidebar-brand-text">Admin Panel</span>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="sidebar-icon">📊</span> Dashboard
            </a>
            <a href="{{ route('admin.clientes') }}"
               class="sidebar-link {{ request()->routeIs('admin.clientes*') ? 'active' : '' }}">
                <span class="sidebar-icon">👥</span> Clientes
            </a>
            <a href="{{ route('admin.servicios') }}"
               class="sidebar-link {{ request()->routeIs('admin.servicios*') ? 'active' : '' }}">
                <span class="sidebar-icon">✨</span> Servicios
            </a>
            <a href="{{ route('admin.disponibilidad') }}"
               class="sidebar-link {{ request()->routeIs('admin.disponibilidad*') ? 'active' : '' }}">
                <span class="sidebar-icon">🗓️</span> Disponibilidad
            </a>
            <a href="{{ route('admin.citas') }}"
               class="sidebar-link {{ request()->routeIs('admin.citas*') ? 'active' : '' }}">
                <span class="sidebar-icon">📋</span> Citas
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('inicio') }}" class="sidebar-link">
                <span class="sidebar-icon">🌐</span> Ver sitio
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link sidebar-logout">
                    <span class="sidebar-icon">🚪</span> Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- ── CONTENIDO ── --}}
    <div class="admin-main">

        {{-- Topbar --}}
        <header class="admin-topbar">
            <button class="sidebar-toggle" id="sidebarToggle">☰</button>
            <div class="admin-topbar-right">
        <span class="admin-user">
          {{ session('cliente_nombres') }} {{ session('cliente_apellidos') }}
        </span>
                <div class="nav-avatar">
                    {{ strtoupper(substr(session('cliente_nombres'), 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="flash flash-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash flash-error">⚠️ {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="flash flash-error">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <main class="admin-content">
            @yield('content')
        </main>

    </div>
</div>

<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar')?.classList.toggle('open');
    });
</script>
@stack('scripts')
</body>
</html>
