@extends('layouts.app')
@section('title', 'Agendar Cita')

@section('content')
    <div class="agendar-split">

        {{-- Formulario --}}
        <div class="agendar-form-col">
            <div class="form-card">
                <h2>Agendar Cita</h2>

                <form method="POST" action="{{ route('agendar.store') }}" id="formAgendar">
                    @csrf

                    {{-- Datos del usuario (solo lectura) --}}
                    <div class="field">
                        <label>Nombre</label>
                        <input type="text"
                               value="{{ session('cliente_nombres') }} {{ session('cliente_apellidos') }}"
                               readonly style="background:var(--cream2);cursor:not-allowed;"/>
                    </div>
                    <div class="field">
                        <label>Correo</label>
                        <input type="email" value="{{ session('cliente_correo') }}"
                               readonly style="background:var(--cream2);cursor:not-allowed;"/>
                    </div>

                    {{-- Selección de servicios (múltiple) --}}
                    <div class="field">
                        <label>Servicios <span style="color:var(--gray);font-size:.75rem;">(puedes elegir varios)</span></label>
                        @foreach($servicios as $categoria => $lista)
                            <p style="font-size:.75rem;text-transform:uppercase;letter-spacing:.1em;color:var(--gold);margin:.8rem 0 .4rem;">
                                {{ $categoria }}
                            </p>
                            @foreach($lista as $servicio)
                                <label class="check-label" style="margin-bottom:.35rem;">
                                    <input type="checkbox"
                                           name="servicios[]"
                                           value="{{ $servicio->id }}"
                                           data-precio="{{ $servicio->precio }}"
                                           data-nombre="{{ $servicio->nombre_servicio }}"
                                           class="servicio-check"
                                        {{ in_array($servicio->id, old('servicios', [])) ? 'checked' : '' }}/>
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

                    {{-- Selección de horario disponible --}}
                    <div class="field">
                        <label for="id_disponibilidad">Horario disponible</label>
                        <div class="select-wrap">
                            <select id="id_disponibilidad" name="id_disponibilidad"
                                    class="{{ $errors->has('id_disponibilidad') ? 'invalid' : '' }}">
                                <option value="">Selecciona un horario</option>
                                @foreach($disponibilidad as $fecha => $horarios)
                                    <optgroup label="{{ \Carbon\Carbon::parse($fecha)->locale('es')->isoFormat('dddd D [de] MMMM') }}">
                                        @foreach($horarios as $h)
                                            <option value="{{ $h->id }}"
                                                {{ old('id_disponibilidad') == $h->id ? 'selected' : '' }}>
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
                        <label for="observaciones">Observaciones <span style="color:var(--gray);font-size:.75rem;">(opcional)</span></label>
                        <textarea id="observaciones" name="observaciones" rows="2"
                                  placeholder="¿Algo que debamos saber?"
                                  style="width:100%;border:1.5px solid var(--dark);border-radius:.5rem;padding:.75rem 1rem;font-family:'Jost',sans-serif;font-size:.9rem;resize:vertical;outline:none;background:transparent;">{{ old('observaciones') }}</textarea>
                    </div>
                </form>
            </div>
        </div>

        {{-- Resumen + Pago --}}
        <div class="agendar-resumen-col">
            <div class="resumen-card">
                <h3>Resumen</h3>

                <div id="resumen-servicios" style="margin-bottom:.8rem;">
                    <span style="color:var(--gray);font-size:.85rem;">Selecciona un servicio...</span>
                </div>

                <div class="resumen-row">
                    <span class="label">Horario</span>
                    <span id="res-horario">—</span>
                </div>
                <div class="resumen-row resumen-total">
                    <span class="label">Total</span>
                    <span class="value" id="res-total">—</span>
                </div>

                <div class="pago-section">
                    <h4>Anticipo a pagar (50%)</h4>
                    <div class="pago-badge">
                        <div class="pago-monto" id="pago-monto-val">$0</div>
                        <div class="pago-label">Se debita ahora</div>
                    </div>
                </div>

                {{-- Pago simulado --}}
                <div class="pago-form" style="margin-top:1.2rem;">
                    <h4 style="font-size:.8rem;text-transform:uppercase;letter-spacing:.1em;
                   color:var(--gray);margin-bottom:.5rem;">💳 Pago simulado</h4>
                    <input type="text" id="numTarjeta" placeholder="Número de tarjeta (16 dígitos)" maxlength="16"/>
                    <div class="pago-form-row">
                        <input type="month" id="expiry" placeholder="MM/AA"/>
                        <input type="text"  id="cvv"    placeholder="CVV" maxlength="4"/>
                    </div>
                    <input type="text" id="nomTarjeta" placeholder="Nombre en la tarjeta"/>
                </div>

                <br/>
                <button class="btn-primary" id="btnConfirmar" style="width:100%;">
                    Confirmar y Pagar
                </button>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const fmt = n => '$' + Number(n).toLocaleString('es-CO');
        let total = 0;

        // Actualizar resumen al marcar/desmarcar servicios
        document.querySelectorAll('.servicio-check').forEach(cb => {
            cb.addEventListener('change', actualizarResumen);
        });

        // Actualizar horario seleccionado
        document.getElementById('id_disponibilidad')?.addEventListener('change', function() {
            const txt = this.options[this.selectedIndex]?.text || '—';
            document.getElementById('res-horario').textContent =
                this.value ? txt.replace(/.*label="(.+?)".*/, '$1') + ' · ' + txt : '—';
            // Más simple: mostrar el texto de la opción directamente
            document.getElementById('res-horario').textContent = this.value ? txt : '—';
        });

        function actualizarResumen() {
            const checks  = document.querySelectorAll('.servicio-check:checked');
            total = 0;
            const nombres = [];

            checks.forEach(cb => {
                total += parseFloat(cb.dataset.precio);
                nombres.push(cb.dataset.nombre);
            });

            const anticipo = total * 0.5;

            // Lista de servicios
            const cont = document.getElementById('resumen-servicios');
            if (nombres.length === 0) {
                cont.innerHTML = '<span style="color:var(--gray);font-size:.85rem;">Selecciona un servicio...</span>';
            } else {
                cont.innerHTML = nombres.map(n =>
                    `<div class="resumen-row"><span>${n}</span></div>`
                ).join('');
            }

            document.getElementById('res-total').textContent      = total    ? fmt(total)    : '—';
            document.getElementById('pago-monto-val').textContent = anticipo ? fmt(anticipo) : '$0';
        }

        // Confirmar y pagar
        document.getElementById('btnConfirmar')?.addEventListener('click', function() {
            const checks = document.querySelectorAll('.servicio-check:checked');
            if (checks.length === 0) { alert('Selecciona al menos un servicio.'); return; }

            const horario = document.getElementById('id_disponibilidad')?.value;
            if (!horario) { alert('Selecciona un horario disponible.'); return; }

            const num = document.getElementById('numTarjeta')?.value.replace(/\s/g,'');
            const exp = document.getElementById('expiry')?.value;
            const cvv = document.getElementById('cvv')?.value.trim();

            if (!num || num.length < 16) { alert('Número de tarjeta inválido (16 dígitos).'); return; }
            if (!exp)                     { alert('Ingresa la fecha de vencimiento.'); return; }
            if (!cvv || cvv.length < 3)   { alert('CVV inválido.'); return; }

            document.getElementById('formAgendar').submit();
        });
    </script>
@endpush
