@extends('layouts.admin')
@section('title', 'Disponibilidad – Admin')

@section('content')

    <div class="admin-page-header">
        <h1>Disponibilidad</h1>
    </div>

    <div style="display:grid;grid-template-columns:1fr 380px;gap:1.5rem;align-items:flex-start;">

        {{-- Tabla de horarios --}}
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora inicio</th>
                    <th>Hora fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($horarios as $h)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($h->fecha)->format('d/m/Y') }}</td>
                        <td>{{ $h->hora_inicio }}</td>
                        <td>{{ $h->hora_fin }}</td>
                        <td>
                            @php
                                $badge = match($h->estado_disponibilidad) {
                                  'disponible' => 'badge-verde',
                                  'ocupado'    => 'badge-rojo',
                                  'bloqueado'  => 'badge-gris',
                                  default      => 'badge-gris',
                                };
                            @endphp
                            <span class="badge {{ $badge }}">{{ ucfirst($h->estado_disponibilidad) }}</span>
                        </td>
                        <td>
                            @if($h->estado_disponibilidad === 'disponible')
                                <form method="POST"
                                      action="{{ route('admin.disponibilidad.destroy', $h->id) }}"
                                      onsubmit="return confirm('¿Eliminar este horario?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-sm btn-sm-delete">Eliminar</button>
                                </form>
                            @else
                                <span style="font-size:.75rem;color:var(--gray);">Con cita</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:var(--gray);padding:2rem;">
                            Sin horarios creados aún.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Formulario nuevo horario --}}
        <div class="admin-form-card" style="max-width:100%;">
            <h2>Nuevo Horario</h2>
            <form method="POST" action="{{ route('admin.disponibilidad.store') }}">
                @csrf
                <div class="field">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha"
                           min="{{ date('Y-m-d') }}"
                           value="{{ old('fecha') }}"
                           class="{{ $errors->has('fecha') ? 'invalid' : '' }}"/>
                    @error('fecha')<span class="error-msg show">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="hora_inicio">Hora inicio</label>
                    <input type="time" id="hora_inicio" name="hora_inicio"
                           value="{{ old('hora_inicio') }}"
                           class="{{ $errors->has('hora_inicio') ? 'invalid' : '' }}"/>
                    @error('hora_inicio')<span class="error-msg show">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="hora_fin">Hora fin</label>
                    <input type="time" id="hora_fin" name="hora_fin"
                           value="{{ old('hora_fin') }}"
                           class="{{ $errors->has('hora_fin') ? 'invalid' : '' }}"/>
                    @error('hora_fin')<span class="error-msg show">{{ $message }}</span>@enderror
                </div>
                <br/>
                <button type="submit" class="btn-primary" style="width:100%;">
                    Agregar horario
                </button>
            </form>
        </div>

    </div>

@endsection
