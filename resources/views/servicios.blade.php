@extends('layouts.app')
@section('title', 'Servicios – Leanny Alzate Cosmetología')

@section('content')
    <div class="servicios-wrapper">
        <h2 class="section-title">Nuestros Servicios</h2>

        @php
            $iconos = [
              'Corporales'   => '💆',
              'Faciales'     => '🪷',
              'Depilación'   => '🕯️',
              'Sueroterapia' => '💉',
            ];
        @endphp

        <div class="servicios-grid">
            @foreach($servicios as $categoria => $lista)
                <div class="servicio-card">
                    <div class="servicio-img">{{ $iconos[$categoria] ?? '✨' }}</div>
                    <div class="servicio-content">
                        <h3>{{ $categoria }}</h3>
                        <ul class="servicio-list">
                            @foreach($lista as $servicio)
                                <li>
                                    {{ $servicio->nombre_servicio }}
                                    <span>${{ number_format($servicio->precio, 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
