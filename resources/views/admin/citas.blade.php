@extends('layouts.admin')
@section('title', 'Citas – Admin')

@section('content')

    <div class="admin-page-header">
        <h1>Todas las Citas</h1>
        <span class="badge badge-gold">{{ $citas->count() }} en total</span>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Servicio(s)</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Total</th>
                <th>Anticipo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->id }}</td>
                    <td>{{ $cita->cliente->nombres }} {{ $cita->cliente->apellidos }}</td>
                    <td>{{ $cita->detalles->map(fn($d) => $d->servicio->nombre_servicio)->join(', ') }}</td>
                    <td>{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}</td>
                    <td>{{ $cita->hora_inicio }}</td>
                    <td>${{ number_format($cita->detalles->sum('subtotal'), 0, ',', '.') }}</td>
                    <td>${{ $cita->pago ? number_format($cita->pago->monto, 0, ',', '.') : '—' }}</td>
                    <td>
                        @php
                            $badge = match($cita->estado_cita) {
                              'confirmada' => 'badge-verde',
                              'pendiente'  => 'badge-amarillo',
                              'cancelada'  => 'badge-rojo',
                              'completada' => 'badge-gris',
                              default      => 'badge-gris',
                            };
                        @endphp
                        <span class="badge {{ $badge }}">{{ ucfirst($cita->estado_cita) }}</span>
                    </td>
                    <td>
                        @if($cita->estado_cita !== 'cancelada')
                            <form method="POST"
                                  action="{{ route('admin.citas.destroy', $cita->id) }}"
                                  onsubmit="return confirm('¿Cancelar esta cita?')">
                                @csrf @method('DELETE')
                                <input type="hidden" name="motivo" value="Cancelado por administrador"/>
                                <button type="submit" class="btn-sm btn-sm-delete">Cancelar</button>
                            </form>
                        @else
                            <span style="font-size:.75rem;color:var(--gray);">
                {{ $cita->cancelacion?->motivo ?? 'Cancelada' }}
              </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center;color:var(--gray);padding:2rem;">
                        Sin citas registradas aún.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
