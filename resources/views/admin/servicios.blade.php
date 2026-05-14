@extends('layouts.admin')
@section('title', 'Servicios – Admin')

@section('content')

    <div class="admin-page-header">
        <h1>Servicios</h1>
        <a href="{{ route('admin.servicios.create') }}" class="btn-primary">+ Nuevo servicio</a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Duración</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->id }}</td>
                    <td>{{ $servicio->nombre_servicio }}</td>
                    <td>{{ $servicio->categoria }}</td>
                    <td>${{ number_format($servicio->precio, 0, ',', '.') }}</td>
                    <td>{{ $servicio->duracion_estimada }} min</td>
                    <td>
            <span class="badge {{ $servicio->estado_servicio === 'activo' ? 'badge-verde' : 'badge-rojo' }}">
              {{ ucfirst($servicio->estado_servicio) }}
            </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.servicios.edit', $servicio->id) }}"
                               class="btn-sm btn-sm-edit">Editar</a>
                            <form method="POST"
                                  action="{{ route('admin.servicios.destroy', $servicio->id) }}"
                                  onsubmit="return confirm('¿Eliminar este servicio?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-sm-delete">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;color:var(--gray);padding:2rem;">Sin servicios aún.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
