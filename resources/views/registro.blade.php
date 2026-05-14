@extends('layouts.app')
@section('title', 'Registro – Leanny Alzate Cosmetología')

@section('content')
    <div class="form-wrapper">
        <div class="form-card">
            <h2>Crear Cuenta</h2>

            {{-- Banner éxito si viene redirigido --}}
            @if(session('success'))
                <div class="success-banner" style="display:block;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('registro.store') }}" novalidate>
                @csrf

                {{-- Nombres --}}
                <div class="field">
                    <label for="nombres">Nombres</label>
                    <input
                        type="text"
                        id="nombres"
                        name="nombres"
                        value="{{ old('nombres') }}"
                        placeholder="Tu nombre"
                        autocomplete="given-name"
                        class="{{ $errors->has('nombres') ? 'invalid' : '' }}"
                    />
                    @error('nombres')
                    <span class="error-msg show">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Apellidos --}}
                <div class="field">
                    <label for="apellidos">Apellidos</label>
                    <input
                        type="text"
                        id="apellidos"
                        name="apellidos"
                        value="{{ old('apellidos') }}"
                        placeholder="Tus apellidos"
                        autocomplete="family-name"
                        class="{{ $errors->has('apellidos') ? 'invalid' : '' }}"
                    />
                    @error('apellidos')
                    <span class="error-msg show">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Teléfono --}}
                <div class="field">
                    <label for="telefono">
                        Teléfono
                        <span style="color:var(--gray);font-size:.72rem;">(opcional)</span>
                    </label>
                    <input
                        type="tel"
                        id="telefono"
                        name="telefono"
                        value="{{ old('telefono') }}"
                        placeholder="3001234567"
                        autocomplete="tel"
                    />
                </div>

                {{-- Correo --}}
                <div class="field">
                    <label for="correo">Correo electrónico</label>
                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        value="{{ old('correo') }}"
                        placeholder="correo@ejemplo.com"
                        autocomplete="email"
                        class="{{ $errors->has('correo') ? 'invalid' : '' }}"
                    />
                    @error('correo')
                    <span class="error-msg show">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="field">
                    <label for="contrasena">Contraseña</label>
                    <div class="input-icon-wrap">
                        <input
                            type="password"
                            id="contrasena"
                            name="contrasena"
                            placeholder="Mínimo 8 caracteres"
                            autocomplete="new-password"
                            class="{{ $errors->has('contrasena') ? 'invalid' : '' }}"
                        />
                        <button type="button" class="toggle-pass" data-target="contrasena"
                                aria-label="Ver contraseña">👁</button>
                    </div>

                    {{-- Barra de fortaleza --}}
                    <div class="password-strength">
                        <div class="strength-fill" id="strength-fill"></div>
                    </div>
                    <span class="strength-label" id="strength-label"></span>

                    @error('contrasena')
                    <span class="error-msg show">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div class="field">
                    <label for="contrasena_confirmation">Confirmar contraseña</label>
                    <div class="input-icon-wrap">
                        <input
                            type="password"
                            id="contrasena_confirmation"
                            name="contrasena_confirmation"
                            placeholder="Repite tu contraseña"
                            autocomplete="new-password"
                        />
                        <button type="button" class="toggle-pass"
                                data-target="contrasena_confirmation"
                                aria-label="Ver contraseña">👁</button>
                    </div>
                    <span class="error-msg" id="err-confirm"></span>
                </div>

                {{-- Términos --}}
                <div class="field field-check">
                    <label class="check-label">
                        <input type="checkbox" id="terminos" name="terminos"/>
                        <span>Acepto los
            <a href="#" class="link-gold">términos y condiciones</a>
          </span>
                    </label>
                    <span class="error-msg" id="err-terminos"></span>
                </div>

                <br/>

                {{-- Submit --}}
                <div class="btn-block">
                    <button type="submit" id="btnRegistro" class="btn-primary" style="width:100%;">
                        Crear Cuenta
                    </button>
                </div>

                {{-- Link a login --}}
                <p class="form-footer-link">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="link-gold">Inicia sesión</a>
                </p>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // ── Toggle ver/ocultar contraseña ──────────────────
        document.querySelectorAll('.toggle-pass').forEach(btn => {
            btn.addEventListener('click', function () {
                const input  = document.getElementById(this.dataset.target);
                const isText = input.type === 'text';
                input.type   = isText ? 'password' : 'text';
                this.textContent = isText ? '👁' : '🙈';
            });
        });

        // ── Barra de fortaleza de contraseña ───────────────
        document.getElementById('contrasena')?.addEventListener('input', function () {
            const val    = this.value;
            const fill   = document.getElementById('strength-fill');
            const label  = document.getElementById('strength-label');

            let score = val.length;
            if (/[A-Z]/.test(val))       score += 2;
            if (/[0-9]/.test(val))       score += 2;
            if (/[^A-Za-z0-9]/.test(val)) score += 3;

            const niveles = [
                { min: 0,  label: '',           color: 'transparent', width: '0%'   },
                { min: 1,  label: 'Muy débil',  color: '#e74c3c',     width: '20%'  },
                { min: 6,  label: 'Débil',      color: '#e67e22',     width: '40%'  },
                { min: 8,  label: 'Regular',    color: '#f1c40f',     width: '60%'  },
                { min: 10, label: 'Fuerte',     color: '#2ecc71',     width: '80%'  },
                { min: 12, label: 'Muy fuerte', color: '#27ae60',     width: '100%' },
            ];

            const nivel = [...niveles].reverse().find(n => score >= n.min) || niveles[0];
            fill.style.width           = nivel.width;
            fill.style.backgroundColor = nivel.color;
            label.textContent          = nivel.label;
            label.style.color          = nivel.color;
        });

        // ── Validar confirmación de contraseña ─────────────
        document.getElementById('contrasena_confirmation')
            ?.addEventListener('blur', function () {
                const pass    = document.getElementById('contrasena')?.value;
                const confirm = this.value;
                const err     = document.getElementById('err-confirm');
                if (pass !== confirm) {
                    err.textContent = 'Las contraseñas no coinciden.';
                    err.classList.add('show');
                    this.classList.add('invalid');
                } else {
                    err.classList.remove('show');
                    this.classList.remove('invalid');
                }
            });

        // ── Validar términos antes de enviar ───────────────
        document.getElementById('btnRegistro')
            ?.addEventListener('click', function (e) {
                const terminos = document.getElementById('terminos');
                const err      = document.getElementById('err-terminos');
                if (!terminos.checked) {
                    e.preventDefault();
                    err.textContent = 'Debes aceptar los términos y condiciones.';
                    err.classList.add('show');
                } else {
                    err.classList.remove('show');
                }
            });
    </script>
@endpush
