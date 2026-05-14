@extends('layouts.app')
@section('title', 'Inicio – Leanny Alzate Cosmetología')

@section('content')
    <section class="hero">
        <h1 class="hero-tag">Bienvenid@</h1>

        <div class="hero-card">
            <p class="brand">Leanny Alzate</p>
            <p class="brand-name">Cosmetología</p>
            <p class="tagline">Realza tu belleza con nuestros servicios profesionales</p>
        </div>

        @if(session('cliente_id'))
            <a class="btn-primary" href="{{ route('agendar') }}">Agendar Ahora</a>
        @else
            <a class="btn-primary" href="{{ route('registro') }}">Comenzar</a>
        @endif
    </section>
@endsection
