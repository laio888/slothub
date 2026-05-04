@extends('layouts.app')
@section('title', 'Agendar Cita – Leanny Alzate Cosmetología')

@section('content')
    <div class="form-wrapper">
        <div class="form-card">
            <h2>Agendar Cita</h2>

            <div class="success-banner" id="agendarSuccess">
                ✅ ¡Cita agendada! Nos pondremos en contacto pronto.
            </div>

            <div class="field">
                <label for="nombre">Nombre completo</label>
                <input type="text"  id="nombre"   placeholder="Tu nombre completo" autocomplete="name"/>
                <span class="error-msg" id="err-nombre">Por favor ingresa tu nombre.</span>
            </div>

            <div class="field">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo"   placeholder="correo@ejemplo.com" autocomplete="email"/>
                <span class="error-msg" id="err-correo">Ingresa un correo válido.</span>
            </div>

            <div class="field">
                <label for="telefono">Teléfono</label>
                <input type="tel"   id="telefono" placeholder="3001234567" autocomplete="tel"/>
                <span class="error-msg" id="err-telefono">Ingresa un número válido (7–12 dígitos).</span>
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
                <span class="error-msg" id="err-servicio">Selecciona un servicio.</span>
            </div>

            <div class="field">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha"/>
                <span class="error-msg" id="err-fecha">Selecciona una fecha válida (no en el pasado).</span>
            </div>

            <div class="field">
                <label for="hora">Hora</label>
                <input type="time" id="hora"/>
                <span class="error-msg" id="err-hora">Selecciona una hora.</span>
            </div>

            <p class="note">⚠️ Debe pagar el 50% para confirmar la cita</p>

            <div class="btn-block">
                <button class="btn-primary" onclick="submitAgendar()">Agendar Cita</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/agendar.js"></script>
@endpush