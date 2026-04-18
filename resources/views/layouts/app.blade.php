<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'SlotHub') — Agenda tu próxima cita</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}"/>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet"/>

    {{-- CSS principal --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>

    {{-- CSS extra por página (opcional) --}}
    @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
@include('components.navbar')

{{-- CONTENIDO DE CADA PÁGINA --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
@include('components.footer')

{{-- JS principal --}}
<script src="{{ asset('js/main.js') }}"></script>

{{-- JS extra por página (opcional) --}}
@stack('scripts')

</body>
</html>
