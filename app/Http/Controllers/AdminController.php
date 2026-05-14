<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Disponibilidad;
use App\Models\Cancelacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {

    // DASHBOARD ADMIN
    public function dashboard() {
        $stats = [
            'total_clientes'  => Cliente::where('rol', 'cliente')->count(),
            'total_citas'     => Cita::count(),
            'citas_hoy'       => Cita::whereDate('fecha_cita', today())->count(),
            'total_servicios' => Servicio::where('estado_servicio', 'activo')->count(),
        ];

        $citasRecientes = Cita::with(['cliente', 'detalles.servicio', 'pago'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'citasRecientes'));
    }

    // GESTIÓN DE CLIENTES
    // Listar todos los clientes
    public function clientes() {
        $clientes = Cliente::where('rol', 'cliente')
            ->withCount('citas')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.clientes', compact('clientes'));
    }

    // Eliminar cliente
    public function destroyCliente($id) {
        $cliente = Cliente::findOrFail($id);

        // No puede eliminarse a sí mismo
        if ($cliente->id === session('cliente_id')) {
            return back()->withErrors(['error' => 'No puedes eliminarte a ti mismo.']);
        }

        $cliente->delete();

        return redirect()->route('admin.clientes')
            ->with('success', 'Cliente eliminado correctamente.');
    }

    // GESTIÓN DE SERVICIOS
    // Listar servicios
    public function servicios() {
        $servicios = Servicio::orderBy('categoria')->get();
        return view('admin.servicios', compact('servicios'));
    }

    // Formulario crear servicio
    public function createServicio() {
        return view('admin.servicio-form', ['servicio' => null]);
    }

    // Guardar nuevo servicio
    public function storeServicio(Request $request) {
        $request->validate([
            'nombre_servicio'   => 'required|string|max:100',
            'categoria'         => 'required|string|max:100',
            'descripcion'       => 'nullable|string',
            'precio'            => 'required|numeric|min:0',
            'duracion_estimada' => 'required|integer|min:1',
        ], [
            'nombre_servicio.required'   => 'El nombre es obligatorio.',
            'categoria.required'         => 'La categoría es obligatoria.',
            'precio.required'            => 'El precio es obligatorio.',
            'duracion_estimada.required' => 'La duración es obligatoria.',
        ]);

        Servicio::create([
            'nombre_servicio'   => $request->nombre_servicio,
            'categoria'         => $request->categoria,
            'descripcion'       => $request->descripcion,
            'precio'            => $request->precio,
            'duracion_estimada' => $request->duracion_estimada,
            'estado_servicio'   => 'activo',
        ]);

        return redirect()->route('admin.servicios')
            ->with('success', 'Servicio creado correctamente.');
    }

    // Formulario editar servicio
    public function editServicio($id) {
        $servicio = Servicio::findOrFail($id);
        return view('admin.servicio-form', compact('servicio'));
    }

    // Actualizar servicio
    public function updateServicio(Request $request, $id) {
        $request->validate([
            'nombre_servicio'   => 'required|string|max:100',
            'categoria'         => 'required|string|max:100',
            'descripcion'       => 'nullable|string',
            'precio'            => 'required|numeric|min:0',
            'duracion_estimada' => 'required|integer|min:1',
            'estado_servicio'   => 'required|in:activo,inactivo',
        ]);

        Servicio::findOrFail($id)->update($request->only([
            'nombre_servicio',
            'categoria',
            'descripcion',
            'precio',
            'duracion_estimada',
            'estado_servicio',
        ]));

        return redirect()->route('admin.servicios')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    // Eliminar servicio
    public function destroyServicio($id) {
        Servicio::findOrFail($id)->delete();
        return redirect()->route('admin.servicios')
            ->with('success', 'Servicio eliminado correctamente.');
    }

    // GESTIÓN DE DISPONIBILIDAD
    // Listar horarios
    public function disponibilidad() {
        $horarios = Disponibilidad::orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        return view('admin.disponibilidad', compact('horarios'));
    }

    // Guardar nuevo horario
    public function storeDisponibilidad(Request $request) {
        $request->validate([
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required|after:hora_inicio',
        ], [
            'fecha.required'            => 'La fecha es obligatoria.',
            'fecha.after_or_equal'      => 'La fecha no puede ser en el pasado.',
            'hora_inicio.required'      => 'La hora de inicio es obligatoria.',
            'hora_fin.required'         => 'La hora de fin es obligatoria.',
            'hora_fin.after'            => 'La hora de fin debe ser mayor a la de inicio.',
        ]);

        // Evitar horarios duplicados en la misma fecha
        $existe = Disponibilidad::where('fecha', $request->fecha)
            ->where('hora_inicio', $request->hora_inicio)
            ->exists();

        if ($existe) {
            return back()->withErrors(['hora_inicio' => 'Ya existe un horario en esa fecha y hora.']);
        }

        Disponibilidad::create([
            'fecha'                  => $request->fecha,
            'hora_inicio'            => $request->hora_inicio,
            'hora_fin'               => $request->hora_fin,
            'estado_disponibilidad'  => 'disponible',
        ]);

        return redirect()->route('admin.disponibilidad')
            ->with('success', 'Horario creado correctamente.');
    }

    // Eliminar horario
    public function destroyDisponibilidad($id) {
        $horario = Disponibilidad::findOrFail($id);

        if ($horario->estado_disponibilidad === 'ocupado') {
            return back()->withErrors(['error' => 'No puedes eliminar un horario con cita asignada.']);
        }

        $horario->delete();

        return redirect()->route('admin.disponibilidad')
            ->with('success', 'Horario eliminado correctamente.');
    }

    // GESTIÓN DE CITAS (admin ve todas)
    // Listar todas las citas
    public function citas() {
        $citas = Cita::with(['cliente', 'detalles.servicio', 'pago', 'cancelacion'])
            ->orderBy('fecha_cita', 'desc')
            ->get();

        return view('admin.citas', compact('citas'));
    }

    // Cancelar cualquier cita (como admin)
    public function destroyCita(Request $request, $id) {
        $cita = Cita::findOrFail($id);

        DB::transaction(function () use ($request, $cita) {

            Cancelacion::create([
                'fecha_cancelacion' => now()->toDateString(),
                'motivo'            => $request->motivo ?? 'Cancelado por administrador',
                'reembolso'         => $request->reembolso ?? 0,
                'id_cita'           => $cita->id,
            ]);

            $cita->update(['estado_cita' => 'cancelada']);

            if ($cita->disponibilidad) {
                $cita->disponibilidad->update(['estado_disponibilidad' => 'disponible']);
            }
        });

        return redirect()->route('admin.citas')
            ->with('success', 'Cita cancelada correctamente.');
    }
}
