@extends('layouts.app')
@section('title', 'Mis Citas – Leanny Alzate Cosmetología')

@section('content')
    <div class="mis-citas-wrapper">

        <div class="citas-header">
            <h1>Mis Citas</h1>
            <a href="/agendar" class="btn-primary">+ Nueva cita</a>
        </div>

        <div id="citasContainer">
            {{-- Renderizado por misCitas.js --}}
        </div>

    </div>
@endsection

@push('scripts')
    <script type="module" src="/js/misCitas.js"></script>
@endpush
