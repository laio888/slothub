@extends('layouts.app')

@section('title', 'Iniciar sesión')

@push('styles')
    <style>
        body { overflow: hidden; }
        main { height: 100vh; }
        .auth-split { height: 100vh; }
    </style>
@endpush

@section('content')
    <div class="auth-split">

        {{-- PANEL IZQUIERDO --}}
        <div class="auth-left">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="grid-overlay"></div>
            <div class="auth-left-content">
                <a href="{{ route('home') }}" class="logo">Slot<strong>Hub</strong></a>
                <div class="auth-promo">
                    <h2>Bienvenido<br/>de vuelta</h2>
                    <p>Accede a tu panel, gestiona tus citas y mantente al día con tus reservas.</p>
                    <div class="auth-quote">
                        <p>"SlotHub cambió la forma en que manejo las citas de mi barbería. Todo en un solo lugar."</p>
                        <span>— Andrés M., aliado desde 2024</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- PANEL DERECHO --}}
        <div class="auth-right">
            <div class="auth-form-wrap">

                <div class="auth-mobile-logo">
                    <a href="{{ route('home') }}" class="logo">Slot<strong>Hub</strong></a>
                </div>

                <h1 class="auth-title">Iniciar sesión</h1>
                <p class="auth-sub">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate gratis</a></p>

                <form class="auth-form" id="loginForm" novalidate>
                    @csrf

                    {{-- EMAIL --}}
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                            <input type="email" id="email" name="email"
                                   placeholder="tu@correo.com"
                                   autocomplete="email" required/>
                        </div>
                        <span class="field-error" id="emailError"></span>
                    </div>

                    {{-- CONTRASEÑA --}}
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-wrap">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                            <input type="password" id="password" name="password"
                                   placeholder="Tu contraseña"
                                   autocomplete="current-password" required minlength="8"/>
                            <button type="button" class="toggle-pass" data-target="password">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                        <span class="field-error" id="passwordError"></span>
                    </div>

                    {{-- RECORDARME --}}
                    <div class="form-row-between">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember" id="remember"/>
                            <span class="checkmark"></span>
                            Recordarme
                        </label>
                        <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="btn-submit">
                        Iniciar sesión
                    </button>

                    <div class="auth-divider"><span>o continúa con</span></div>

                    <div class="social-btns">
                        <button type="button" class="btn-social">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Google
                        </button>
                    </div>

                </form>

                <p class="auth-footer-note">
                    Al continuar, aceptas nuestros <a href="#">Términos de uso</a> y <a href="#">Política de privacidad</a>.
                </p>

            </div>
        </div>

    </div>
@endsection
