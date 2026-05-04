@extends('layouts.app') 
@section('title', 'Login – Leanny Alzate Cosmetología') 

@section('content') 
<div class="form-wrapper"> 
    <div class="form-card"> 
        <h2>Iniciar Sesión</h2> 
        <div class="success-banner" id="loginSuccess"> 
            ✅ Acceso correcto. Redirigiendo… </div> 
            <div class="field"> 
                <label for="loginEmail">Correo electrónico</label> 
                <input type="email" id="loginEmail" placeholder="correo@ejemplo.com" autocomplete="email"/> 
                <span class="error-msg" id="err-loginEmail">Ingresa un correo válido.</span> 
            </div> 
            <div class="field"> 
                <label for="loginPass">Contraseña</label> 
                <input type="password" id="loginPass" placeholder="••••••••" autocomplete="current-password"/> 
                <span class="error-msg" id="err-loginPass">La contraseña no puede estar vacía.</span> 
            </div> 
            <br/> 
            <div class="btn-block"> 
                <button class="btn-primary" onclick="submitLogin()">Ingresar</button> 
            </div>
         </div> 
    </div> 
    @endsection

    @push('scripts') 
    <script src="/js/login.js"></script> 
@endpush