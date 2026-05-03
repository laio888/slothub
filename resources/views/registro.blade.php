@extends('layouts.app')
@section('title', 'Registro – Leanny Alzate Cosmetología')

@section('content')
    <div class="form-wrapper">
        <div class="form-card">
            <h2>Crear Cuenta</h2>

            <div class="success-banner" id="registroSuccess">
                ✅ ¡Cuenta creada exitosamente! Ya puedes iniciar sesión.
            </div>

            <div class="field">
                <label for="reg-nombre">Nombre completo</label>
                <input type="text" id="reg-nombre" placeholder="Tu nombre completo" autocomplete="name"/>
                <span class="error-msg" id="err-reg-nombre">Por favor ingresa tu nombre completo.</span>
            </div>

            <div class="field">
                <label for="reg-email">Correo electrónico</label>
                <input type="email" id="reg-email" placeholder="correo@ejemplo.com" autocomplete="email"/>
                <span class="error-msg" id="err-reg-email">Ingresa un correo electrónico válido.</span>
            </div>

            <div class="field">
                <label for="reg-telefono">Teléfono</label>
                <input type="tel" id="reg-telefono" placeholder="3001234567" autocomplete="tel"/>
                <span class="error-msg" id="err-reg-telefono">Ingresa un número válido (7–12 dígitos).</span>
            </div>

            <div class="field">
                <label for="reg-password">Contraseña</label>
                <div class="input-icon-wrap">
                    <input type="password" id="reg-password" placeholder="Mínimo 8 caracteres" autocomplete="new-password"/>
                    <button type="button" class="toggle-pass" data-target="reg-password" aria-label="Ver contraseña">👁</button>
                </div>
                <div class="password-strength" id="strength-bar">
                    <div class="strength-fill" id="strength-fill"></div>
                </div>
                <span class="strength-label" id="strength-label"></span>
                <span class="error-msg" id="err-reg-password">La contraseña debe tener al menos 8 caracteres.</span>
            </div>

            <div class="field">
                <label for="reg-confirm">Confirmar contraseña</label>
                <div class="input-icon-wrap">
                    <input type="password" id="reg-confirm" placeholder="Repite tu contraseña" autocomplete="new-password"/>
                    <button type="button" class="toggle-pass" data-target="reg-confirm" aria-label="Ver contraseña">👁</button>
                </div>
                <span class="error-msg" id="err-reg-confirm">Las contraseñas no coinciden.</span>
            </div>

            <div class="field field-check">
                <label class="check-label">
                    <input type="checkbox" id="reg-terminos"/>
                    <span>Acepto los <a href="#" class="link-gold">términos y condiciones</a></span>
                </label>
                <span class="error-msg" id="err-reg-terminos">Debes aceptar los términos.</span>
            </div>

            <br/>
            <div class="btn-block">
                <button class="btn-primary" id="btnRegistro">Crear Cuenta</button>            </div>

            <p class="form-footer-link">
                ¿Ya tienes cuenta? <a href="/login" class="link-gold">Inicia sesión</a>
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module" src="/js/registro.js"></script>
@endpush
