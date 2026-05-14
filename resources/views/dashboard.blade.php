@extends('layouts.app')
@section('title', 'Mi Panel')

@section('content')
    <div class="dashboard-wrapper">

        <div class="dashboard-header">
            <h1>Hola, {{ session('cliente_nombres') }} 👋</h1>
            <p>Bienvenida de nuevo. ¿Qué deseas hacer hoy?</p>
        </div>

        <div class="dashboard-cards">
            <div class="dash-card">
                <span class="dc-icon">🗓️</span>
                <span class="dc-label">Citas agendadas</span>
                <span class="dc-value">{{ $citas->count() }}</span>
            </div>
            <div class="dash-card">
                <span class="dc-icon">✅</span>
                <span class="dc-label">Confirmadas</span>
                <span class="dc-value">{{ $citas->where('estado_cita','confirmada')->count() }}</span>
            </div>
            <div class="dash-card">
                <span class="dc-icon">💰</span>
                <span class="dc-label">Total anticipos pagados</span>
                <span class="dc-value" style="font-size:1rem;padding-top:.4rem;">
        ${{ number_format($citas->filter(fn($c) => $c->pago)->sum(fn($c) => $c->pago->monto), 0, ',', '.') }}
      </span>
            </div>
        </div>

        <div class="dash-actions">
            <a href="{{ route('agendar') }}"   class="btn-primary">+ Nueva Cita</a>
            <a href="{{ route('mis-citas') }}" class="btn-secondary">Ver mis citas</a>
            <a href="{{ route('servicios') }}" class="btn-secondary">Ver servicios</a>
        </div>

        @if($citas->where('estado_cita','!=','cancelada')->isNotEmpty())
            <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.6rem;
               font-weight:400;margin:2rem 0 1rem;">Próximas citas</h3>

            @foreach($citas->where('estado_cita','!=','cancelada')->take(3) as $cita)
                <div class="cita-card">
                    <div class="cita-info">
          <span class="cita-servicio">
            {{ $cita->detalles->map(fn($d) => $d->servicio->nombre_servicio)->join(' · ') }}
          </span>
                        <div class="cita-meta">
                            <span>📅 {{ \Carbon\Carbon::parse($cita->fecha_cita)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</span>
                            <span>🕐 {{ $cita->hora_inicio }}</span>
                        </div>
                    </div>
                    <span class="cita-badge badge-pagada">{{ ucfirst($cita->estado_cita) }}</span>
                </div>
            @endforeach
        @endif

    </div>
@endsection
