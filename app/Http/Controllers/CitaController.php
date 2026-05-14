<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\DetalleCita;
use App\Models\Disponibilidad;
use App\Models\Pago;
use App\Models\Cancelacion;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller {


    // DASHBOARD CLIENTE
    public function dashboard() {
        $clienteId = session('cliente_id');

        $citas = Cita::with(['detalles.servicio', 'pago', 'cancelacion', 'disponibilidad'])
            ->where('id_cliente', $clienteId)
            ->orderBy('fecha_cita', 'asc')
            ->get();

        return view('dashboard', compact('citas'));
    }

    // MIS CITAS — CONSULTAR (READ)
    public function misCitas() {
        $clienteId = session('cliente_id');

        $citas = Cita::with(['detalles.servicio', 'pago', 'cancelacion', 'disponibilidad'])
            ->where('id_cliente', $clienteId)
            ->orderBy('fecha_cita', 'desc')
            ->get();

        return view('mis-citas', compact('citas'));
    }

    // AGENDAR — FORMULARIO (READ)
    public function showAgendar() {
        // Servicios activos agrupados por categoría
        $servicios = Servicio::where('estado_servicio', 'activo')
            ->orderBy('categoria')
            ->get()
            ->groupBy('categoria');

        // Horarios disponibles desde hoy
        $disponibilidad = Disponibilidad::where('estado_disponibilidad', 'disponible')
            ->where('fecha', '>=', now()->toDateString())
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get()
            ->groupBy('fecha');

        return view('agendar', compact('servicios', 'disponibilidad'));
    }

    // AGENDAR — GUARDAR (INSERT)
    public function store(Request $request) {
        $request->validate([
            'id_disponibilidad' => 'required|exists:disponibilidad,id',
            'servicios'         => 'required|array|min:1',
            'servicios.*'       => 'exists:servicios,id',
        ], [
            'id_disponibilidad.required' => 'Selecciona un horario disponible.',
            'servicios.required'         => 'Selecciona al menos un servicio.',
        ]);

        // Verificar que el horario sigue disponible
        $disponibilidad = Disponibilidad::findOrFail($request->id_disponibilidad);
        if ($disponibilidad->estado_disponibilidad !== 'disponible') {
            return back()->withErrors(['id_disponibilidad' => 'Este horario ya no está disponible.']);
        }

        // Transacción
        DB::transaction(function () use ($request, $disponibilidad) {

            // 1. Crear la cita
            $cita = Cita::create([
                'fecha_cita'        => $disponibilidad->fecha,
                'hora_inicio'       => $disponibilidad->hora_inicio,
                'hora_fin'          => $disponibilidad->hora_fin,
                'estado_cita'       => 'confirmada',
                'observaciones'     => $request->observaciones,
                'id_cliente'        => session('cliente_id'),
                'id_disponibilidad' => $disponibilidad->id,
            ]);

            // 2. Guardar detalle por cada servicio seleccionado
            $totalCita = 0;
            foreach ($request->servicios as $servicioId) {
                $servicio = Servicio::findOrFail($servicioId);
                $subtotal = $servicio->precio;
                $totalCita += $subtotal;

                DetalleCita::create([
                    'id_cita'     => $cita->id,
                    'id_servicio' => $servicio->id,
                    'cantidad'    => 1,
                    'subtotal'    => $subtotal,
                ]);
            }

            // 3. Registrar el pago del anticipo (50%)
            Pago::create([
                'fecha_pago'      => now()->toDateString(),
                'monto'           => round($totalCita * 0.5, 2),
                'metodo_pago'     => $request->metodo_pago ?? 'tarjeta',
                'estado_pago'     => 'completado',
                'referencia_pago' => 'REF-' . strtoupper(uniqid()),
                'id_cita'         => $cita->id,
            ]);

            // 4. Marcar horario como ocupado
            $disponibilidad->update(['estado_disponibilidad' => 'ocupado']);
        });

        return redirect()->route('mis-citas')
            ->with('success', '¡Cita agendada y anticipo registrado exitosamente!');
    }

    // EDITAR CITA — FORMULARIO (READ)
    public function edit($id) {
        // Solo puede editar sus propias citas
        $cita = Cita::with(['detalles.servicio', 'disponibilidad'])
            ->where('id_cliente', session('cliente_id'))
            ->where('estado_cita', '!=', 'cancelada')
            ->findOrFail($id);

        $servicios = Servicio::where('estado_servicio', 'activo')
            ->orderBy('categoria')
            ->get()
            ->groupBy('categoria');

        $disponibilidad = Disponibilidad::where('estado_disponibilidad', 'disponible')
            ->where('fecha', '>=', now()->toDateString())
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get()
            ->groupBy('fecha');

        return view('cita-edit', compact('cita', 'servicios', 'disponibilidad'));
    }

    // ACTUALIZAR CITA (UPDATE)
    public function update(Request $request, $id) {
        $request->validate([
            'id_disponibilidad' => 'required|exists:disponibilidad,id',
            'servicios'         => 'required|array|min:1',
            'servicios.*'       => 'exists:servicios,id',
        ]);

        $cita = Cita::where('id_cliente', session('cliente_id'))
            ->findOrFail($id);

        $nuevaDisponibilidad = Disponibilidad::findOrFail($request->id_disponibilidad);

        DB::transaction(function () use ($request, $cita, $nuevaDisponibilidad) {

            // 1. Liberar el horario anterior
            if ($cita->disponibilidad) {
                $cita->disponibilidad->update(['estado_disponibilidad' => 'disponible']);
            }

            // 2. Actualizar la cita
            $cita->update([
                'fecha_cita'        => $nuevaDisponibilidad->fecha,
                'hora_inicio'       => $nuevaDisponibilidad->hora_inicio,
                'hora_fin'          => $nuevaDisponibilidad->hora_fin,
                'observaciones'     => $request->observaciones,
                'id_disponibilidad' => $nuevaDisponibilidad->id,
            ]);

            // 3. Borrar detalles anteriores y crear los nuevos
            $cita->detalles()->delete();
            $totalCita = 0;

            foreach ($request->servicios as $servicioId) {
                $servicio  = Servicio::findOrFail($servicioId);
                $subtotal  = $servicio->precio;
                $totalCita += $subtotal;

                DetalleCita::create([
                    'id_cita'     => $cita->id,
                    'id_servicio' => $servicio->id,
                    'cantidad'    => 1,
                    'subtotal'    => $subtotal,
                ]);
            }

            // 4. Actualizar monto del pago existente
            if ($cita->pago) {
                $cita->pago->update([
                    'monto'      => round($totalCita * 0.5, 2),
                    'fecha_pago' => now()->toDateString(),
                ]);
            }

            // 5. Marcar nuevo horario como ocupado
            $nuevaDisponibilidad->update(['estado_disponibilidad' => 'ocupado']);
        });

        return redirect()->route('mis-citas')
            ->with('success', 'Cita actualizada correctamente.');
    }

    // CANCELAR CITA (DELETE LÓGICO)
    public function destroy(Request $request, $id) {
        $cita = Cita::where('id_cliente', session('cliente_id'))
            ->findOrFail($id);

        DB::transaction(function () use ($request, $cita) {

            // 1. Registrar cancelación
            Cancelacion::create([
                'fecha_cancelacion' => now()->toDateString(),
                'motivo'            => $request->motivo ?? 'Cancelado por el cliente',
                'reembolso'         => 0, // sin reembolso por ahora
                'id_cita'           => $cita->id,
            ]);

            // 2. Marcar cita como cancelada
            $cita->update(['estado_cita' => 'cancelada']);

            // 3. Liberar el horario
            if ($cita->disponibilidad) {
                $cita->disponibilidad->update(['estado_disponibilidad' => 'disponible']);
            }
        });

        return redirect()->route('mis-citas')
            ->with('success', 'Cita cancelada correctamente.');
    }
}
