@extends('layouts.app')
@section('title', 'Mi Panel – Leanny Alzate Cosmetología')

@section('content')
    <div class="dashboard-wrapper">

        <div class="dashboard-header">
            <h1 id="dashSaludo">Mi Panel</h1>
            <p>Bienvenida de nuevo. ¿Qué deseas hacer hoy?</p>
        </div>

        <div class="dashboard-cards">
            <div class="dash-card">
                <span class="dc-icon">🗓️</span>
                <span class="dc-label">Citas agendadas</span>
                <span class="dc-value" id="dashCitasCount">0</span>
            </div>
            <div class="dash-card">
                <span class="dc-icon">✦</span>
                <span class="dc-label">Estado de cuenta</span>
                <span class="dc-value" style="font-size:1.1rem;padding-top:.3rem;">Activa</span>
            </div>
        </div>

        <div class="dash-actions">
            <a href="/agendar"   class="btn-primary">+ Nueva Cita</a>
            <a href="/mis-citas" class="btn-secondary">Ver mis citas</a>
            <a href="/servicios" class="btn-secondary">Ver servicios</a>
        </div>

    </div>
@endsection

@push('scripts')
    <script type="module" src="/js/dashboard.js"></script>
@endpush
