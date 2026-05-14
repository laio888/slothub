@extends('layouts.app')
@section('title', 'Mis Citas')

@section('content')
    <div class="mis-citas-wrapper">

        <div class="citas-header">
            <h1>Mis Citas</h1>
            <a href="{{ route('agendar') }}" class="btn-primary">+ Nueva cita</a>
        </div>

        @forelse($citas as $cita)
            <div class="cita-card">
                <div class="cita-info">

        <span class="cita-servicio">
          {{ $cita->detalles->map(fn($d) => $d->servicio->nombre_servicio)->join(' · ') }}
        </span>

                    <div class="cita-meta">
                        <span>📅 {{ \Carbon\Carbon::parse($cita->fecha_cita)->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY') }}</span>
                        <span>🕐 {{ $cita->hora_inicio }} – {{ $cita->hora_fin }}</span>
                        <span>💰 Total: ${{ number_format($cita->detalles->sum('subtotal'), 0, ',', '.') }}</span>
                        @if($cita->pago)
                            <span>✅ Anticipo: ${{ number_format($cita->pago->monto, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    @if($cita->observaciones)
                        <p style="font-size:.8rem;color:var(--gray);margin-top:.4rem;">
                            📝 {{ $cita->observaciones }}
                        </p>
                    @endif

                </div>

                <div class="cita-acciones">
                    @php
                        $badge = match($cita->estado_cita) {
                          'confirmada' => 'badge-pagada',
                          'pendiente'  => 'badge-pendiente',
                          'cancelada'  => 'badge-rojo',
                          default      => 'badge-pendiente',
                        };
                    @endphp
                    <span class="cita-badge {{ $badge }}">{{ ucfirst($cita->estado_cita) }}</span>

                    @if($cita->estado_cita !== 'cancelada')
                        <a href="{{ route('citas.edit', $cita->id) }}"
                           class="btn-secondary" style="padding:.5rem 1.2rem;font-size:.75rem;">
                            Editar
                        </a>

                        <form method="POST"
                              action="{{ route('citas.destroy', $cita->id) }}"
                              onsubmit="return confirm('¿Segura que deseas cancelar esta cita?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger">Cancelar</button>
                        </form>
                    @else
                        <span style="font-size:.78rem;color:var(--gray);">
            Cancelada el {{ \Carbon\Carbon::parse($cita->cancelacion?->fecha_cancelacion)->format('d/m/Y') }}
          </span>
                    @endif
                </div>
            </div>
        @empty
            <div class="citas-empty">
                <div class="empty-icon">🗓️</div>
                <p>Aún no tienes citas agendadas.</p>
                <br/>
                <a href="{{ route('agendar') }}" class="btn-primary">Agendar mi primera cita</a>
            </div>
        @endforelse

    </div>
@endsection
