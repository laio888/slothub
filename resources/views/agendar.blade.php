@extends('layouts.app')
@section('title', 'Agendar Cita – Leanny Alzate Cosmetología')

@section('content')
    <div class="agendar-split">

        {{-- COLUMNA FORMULARIO --}}
        <div class="agendar-form-col">
            <div class="form-card">
                <h2>Agendar Cita</h2>

                <div class="field">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" autocomplete="name"/>
                    <span class="error-msg" id="err-nombre"></span>
                </div>
                <div class="field">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" autocomplete="email"/>
                    <span class="error-msg" id="err-correo"></span>
                </div>
                <div class="field">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" placeholder="3001234567"/>
                    <span class="error-msg" id="err-telefono"></span>
                </div>
                <div class="field">
                    <label for="servicio">Servicio</label>
                    <div class="select-wrap">
                        <select id="servicio">
                            <option value="">Seleccione un servicio</option>
                            <optgroup label="Corporales">
                                <option>Reducción</option>
                                <option>Post operatorios</option>
                                <option>Tonificación</option>
                                <option>Volumen de Glúteos</option>
                                <option>Cauterización de lunares</option>
                                <option>Masajes de relajación</option>
                            </optgroup>
                            <optgroup label="Ttos Faciales">
                                <option>Limpieza facial</option>
                                <option>Plasma capilar</option>
                                <option>Plasma 4ª generación</option>
                                <option>Hidratación de labios</option>
                                <option>Relleno de surcos</option>
                                <option>Botox natural lifting facial</option>
                            </optgroup>
                            <optgroup label="Depilación con Cera">
                                <option>Cejas</option>
                                <option>Cejas con henna</option>
                                <option>Bigote</option>
                                <option>Axilas</option>
                                <option>Bikini</option>
                                <option>Media pierna</option>
                                <option>Pierna completa</option>
                            </optgroup>
                            <optgroup label="Sueroterapia">
                                <option>Detox</option>
                                <option>Nutrición</option>
                                <option>Obesidad</option>
                                <option>Metabolismo</option>
                                <option>Colágeno</option>
                            </optgroup>
                        </select>
                    </div>
                    <span class="error-msg" id="err-servicio"></span>
                </div>
                <div class="field">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha"/>
                    <span class="error-msg" id="err-fecha"></span>
                </div>
                <div class="field">
                    <label for="hora">Hora</label>
                    <input type="time" id="hora"/>
                    <span class="error-msg" id="err-hora"></span>
                </div>
            </div>
        </div>

        {{-- COLUMNA RESUMEN + PAGO --}}
        <div class="agendar-resumen-col">
            <div class="resumen-card">
                <h3>Resumen</h3>

                <div class="resumen-row">
                    <span class="label">Servicio</span>
                    <span id="res-servicio">—</span>
                </div>
                <div class="resumen-row">
                    <span class="label">Fecha</span>
                    <span id="res-fecha">—</span>
                </div>
                <div class="resumen-row">
                    <span class="label">Hora</span>
                    <span id="res-hora">—</span>
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
                    <div class="resumen-row">
                        <span class="label">Anticipo (50%)</span>
                        <span id="res-anticipo">—</span>
                    </div>
                </div>

                {{-- PAGO SIMULADO --}}
                <div class="pago-form" style="margin-top:1.2rem;">
                    <h4 style="font-size:.8rem;text-transform:uppercase;letter-spacing:.1em;color:var(--gray);margin-bottom:.3rem;">
                        💳 Datos de pago (simulado)
                    </h4>
                    <input type="text" id="numTarjeta" placeholder="Número de tarjeta (16 dígitos)"
                           maxlength="16" inputmode="numeric"/>
                    <div class="pago-form-row">
                        <input type="month" id="expiry" placeholder="MM/AA"/>
                        <input type="text"  id="cvv"    placeholder="CVV" maxlength="4" inputmode="numeric"/>
                    </div>
                    <input type="text" id="nomTarjeta" placeholder="Nombre en la tarjeta"/>
                </div>

                <br/>
                <button class="btn-primary" id="btnAgendar" style="width:100%;">
                    Confirmar y Pagar
                </button>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script type="module" src="/js/agendar.js"></script>
@endpush
