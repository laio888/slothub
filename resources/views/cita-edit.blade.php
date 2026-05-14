@extends('layouts.app')
@section('title', 'Editar Cita')

@section('content')
    <div class="form-wrapper">
        <div class="form-card" style="max-width:600px;">
            <h2>Editar Cita</h2>

            <form method="POST" action="{{ route('citas.update', $cita->id) }}">
                @csrf @method('PUT')

                {{-- Servicios --}}
                <div class="field">
                    <label>Servicios</label>
                    @foreach($servicios as $categoria => $lista)
                        <p style="font-size:.75rem;text-transform:uppercase;letter-spacing:.1em;
                    color:var(--gold);margin:.8rem 0 .4rem;">{{ $categoria }}</p>
                        @foreach($lista as $servicio)
                            <label class="check-label" style="margin-bottom:.35rem;">
                                <input type="checkbox"
                                       name="servicios[]"
                                       value="{{ $servicio->id }}"
                                    {{ $cita->detalles->pluck('id_servicio')->contains($servicio->id) ? 'checked' : '' }}/>
                                <span>{{ $servicio->nombre_servicio }}
                <span style="color:var(--gray);">
                  — ${{ number_format($servicio->precio, 0, ',', '.') }}
                </span>
              </span>
                            </label>
                        @endforeach
                    @endforeach
                    @error('servicios')<span class="error-msg show">{{ $message }}</span>@enderror
                </div>

                {{-- Horario --}}
                <div class="field">
                    <label for="id_disponibilidad">Horario disponible</label>
                    <div class="select-wrap">
                        <select id="id_disponibilidad" name="id_disponibilidad"
                                class="{{ $errors->has('id_disponibilidad') ? 'invalid' : '' }}">
                            {{-- Incluir horario actual aunque esté ocupado --}}
                            <option value="{{ $cita->id_disponibilidad }}" selected>
                                {{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}
                                · {{ $cita->hora_inicio }} – {{ $cita->hora_fin }} (actual)
                            </option>
                            @foreach($disponibilidad as $fecha => $horarios)
                                <optgroup label="{{ \Carbon\Carbon::parse($fecha)->locale('es')->isoFormat('dddd D [de] MMMM') }}">
                                    @foreach($horarios as $h)
                                        <option value="{{ $h->id }}">
                                            {{ $h->hora_inicio }} – {{ $h->hora_fin }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    @error('id_disponibilidad')<span class="error-msg show">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="observaciones">Observaciones</label>
                    <textarea id="observaciones" name="observaciones" rows="2"
                              style="width:100%;border:1.5px solid var(--dark);border-radius:.5rem;
                 padding:.75rem 1rem;font-family:'Jost',sans-serif;font-size:.9rem;
                 resize:vertical;outline:none;background:transparent;">{{ old('observaciones', $cita->observaciones) }}</textarea>
                </div>

                <br/>
                <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                    <button type="submit" class="btn-primary">Guardar cambios</button>
                    <a href="{{ route('mis-citas') }}" class="btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
