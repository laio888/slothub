@extends('layouts.app')
@section('title', 'Login – Leanny Alzate Cosmetología')

@section('content')
    <div class="form-wrapper">
        <div class="form-card">
            <h2>Iniciar Sesión</h2>

            {{-- Error general --}}
            @if($errors->any())
                <div class="success-banner" style="display:block;background:#fdecea;
           border-color:#f5c6cb;color:#721c24;">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" novalidate>
                @csrf

                {{-- Correo --}}
                <div class="field">
                    <label for="correo">Correo electrónico</label>
                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        value="{{ old('correo', cookie('cosm_correo')) }}"
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
                            placeholder="••••••••"
                            autocomplete="current-password"
                            class="{{ $errors->has('contrasena') ? 'invalid' : '' }}"
                        />
                        <button type="button" class="toggle-pass" data-target="contrasena"
                                aria-label="Ver contraseña">👁</button>
                    </div>
                    @error('contrasena')
                    <span class="error-msg show">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Recordarme --}}
                <div class="field field-check">
                    <label class="check-label">
                        <input type="checkbox" name="remember" id="remember"/>
                        <span>Recordarme por 30 días</span>
                    </label>
                </div>

                <br/>

                {{-- Submit --}}
                <div class="btn-block">
                    <button type="submit" class="btn-primary" style="width:100%;">
                        Ingresar
                    </button>
                </div>

                {{-- Link a registro --}}
                <p class="form-footer-link">
                    ¿No tienes cuenta?
                    <a href="{{ route('registro') }}" class="link-gold">Regístrate gratis</a>
                </p>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelector('.toggle-pass')?.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            this.textContent = isText ? '👁' : '🙈';
        });
    </script>
@endpush
