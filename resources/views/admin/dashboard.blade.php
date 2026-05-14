@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')

    <div class="admin-page-header">
        <h1>Dashboard</h1>
        <span style="font-size:.85rem;color:var(--gray);">
    {{ now()->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY') }}
  </span>
    </div>

    {{-- Stats --}}
    <div class="stat-grid">
        <div class="stat-card">
            <span class="stat-icon">👥</span>
            <span class="stat-label">Clientes</span>
            <span class="stat-value">{{ $stats['total_clientes'] }}</span>
        </div>
        <div class="stat-card">
            <span class="stat-icon">📋</span>
            <span class="stat-label">Total citas</span>
            <span class="stat-value">{{ $stats['total_citas'] }}</span>
        </div>
        <div class="stat-card">
            <span class="stat-icon">🗓️</span>
            <span class="stat-label">Citas hoy</span>
            <span class="stat-value">{{ $stats['citas_hoy'] }}</span>
        </div>
        <div class="stat-card">
            <span class="stat-icon">✨</span>
            <span class="stat-label">Servicios activos</span>
            <span class="stat-value">{{ $stats['total_servicios'] }}</span>
        </div>
    </div>

    {{-- Citas recientes --}}
    <div class="admin-page-header" style="margin-top:1rem;">
        <h1 style="font-size:1.5rem;">Citas recientes</h1>
        <a href="{{ route('admin.citas') }}" class="btn-secondary" style="padding:.5rem 1.2rem;font-size:.78rem;">
            Ver todas
        </a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Servicio(s)</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Anticipo</th>
            </tr>
            </thead>
            <tbody>
            @forelse($citasRecientes as $cita)
                <tr>
                    <td>{{ $cita->id }}</td>
                    <td>{{ $cita->cliente->nombres }} {{ $cita->cliente->apellidos }}</td>
                    <td>{{ $cita->detalles->map(fn($d) => $d->servicio->nombre_servicio)->join(', ') }}</td>
                    <td>{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $badge = match($cita->estado_cita) {
                              'confirmada'  => 'badge-verde',
                              'pendiente'   => 'badge-amarillo',
                              'cancelada'   => 'badge-rojo',
                              'completada'  => 'badge-gris',
                              default       => 'badge-gris',
                            };
                        @endphp
                        <span class="badge {{ $badge }}">{{ ucfirst($cita->estado_cita) }}</span>
                    </td>
                    <td>${{ $cita->pago ? number_format($cita->pago->monto, 0, ',', '.') : '—' }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;color:var(--gray);padding:2rem;">Sin citas aún.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
