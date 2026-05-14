@extends('layouts.admin')
@section('title', 'Clientes – Admin')

@section('content')

    <div class="admin-page-header">
        <h1>Clientes</h1>
        <span class="badge badge-gold">{{ $clientes->count() }} registrados</span>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Registro</th>
                <th>Citas</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>{{ $cliente->telefono ?? '—' }}</td>
                    <td>{{ \Carbon\Carbon::parse($cliente->fecha_registro)->format('d/m/Y') }}</td>
                    <td>{{ $cliente->citas_count }}</td>
                    <td>
                        <div class="table-actions">
                            <form method="POST"
                                  action="{{ route('admin.clientes.destroy', $cliente->id) }}"
                                  onsubmit="return confirm('¿Eliminar este cliente y todas sus citas?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-sm-delete">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;color:var(--gray);padding:2rem;">Sin clientes aún.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
