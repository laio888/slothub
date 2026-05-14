@extends('layouts.admin')
@section('title', $servicio ? 'Editar Servicio' : 'Nuevo Servicio')

@section('content')

    <div class="admin-page-header">
        <h1>{{ $servicio ? 'Editar Servicio' : 'Nuevo Servicio' }}</h1>
        <a href="{{ route('admin.servicios') }}" class="btn-secondary"
           style="padding:.5rem 1.2rem;font-size:.78rem;">← Volver</a>
    </div>

    <div class="admin-form-card">
        <h2>{{ $servicio ? $servicio->nombre_servicio : 'Nuevo Servicio' }}</h2>

        <form method="POST"
              action="{{ $servicio ? route('admin.servicios.update', $servicio->id) : route('admin.servicios.store') }}">
            @csrf
            @if($servicio) @method('PUT') @endif

            <div class="form-row">
                <div class="field">
                    <label for="nombre_servicio">Nombre del servicio</label>
                    <input type="text" id="nombre_servicio" name="nombre_servicio"
                           value="{{ old('nombre_servicio', $servicio?->nombre_servicio) }}"
                           placeholder="Ej: Limpieza facial"
                           class="{{ $errors->has('nombre_servicio') ? 'invalid' : '' }}"/>
                    @error('nombre_servicio')<span class="error-msg show">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="categoria">Categoría</label>
                    <div class="select-wrap">
                        <select id="categoria" name="categoria"
                                class="{{ $errors->has('categoria') ? 'invalid' : '' }}">
                            <option value="">Selecciona categoría</option>
                            @foreach(['Corporales','Faciales','Depilación','Sueroterapia'] as $cat)
                                <option value="{{ $cat }}"
                                    {{ old('categoria', $servicio?->categoria) === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('categoria')<span class="error-msg show">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="field">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3"
                          placeholder="Descripción del servicio (opcional)"
                          style="width:100%;border:1.5px solid var(--dark);border-radius:.5rem;padding:.75rem 1rem;font-family:'Jost',sans-serif;font-size:.95rem;resize:vertical;outline:none;background:transparent;">{{ old('descripcion', $servicio?->descripcion) }}</textarea>
            </div>

            <div class="form-row">
                <div class="field">
                    <label for="precio">Precio (COP)</label>
                    <input type="number" id="precio" name="precio" min="0" step="1000"
                           value="{{ old('precio', $servicio?->precio) }}"
                           placeholder="100000"
                           class="{{ $errors->has('precio') ? 'invalid' : '' }}"/>
                    @error('precio')<span class="error-msg show">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="duracion_estimada">Duración (minutos)</label>
                    <input type="number" id="duracion_estimada" name="duracion_estimada" min="1"
                           value="{{ old('duracion_estimada', $servicio?->duracion_estimada) }}"
                           placeholder="60"
                           class="{{ $errors->has('duracion_estimada') ? 'invalid' : '' }}"/>
                    @error('duracion_estimada')<span class="error-msg show">{{ $message }}</span>@enderror
                </div>
            </div>

            @if($servicio)
                <div class="field">
                    <label for="estado_servicio">Estado</label>
                    <div class="select-wrap">
                        <select id="estado_servicio" name="estado_servicio">
                            <option value="activo"   {{ $servicio->estado_servicio === 'activo'   ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ $servicio->estado_servicio === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>
            @endif

            <br/>
            <div style="display:flex;gap:1rem;">
                <button type="submit" class="btn-primary">
                    {{ $servicio ? 'Guardar cambios' : 'Crear servicio' }}
                </button>
                <a href="{{ route('admin.servicios') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
