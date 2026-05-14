<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller {

    // REGISTRO
    public function showRegistro() {
        // Si ya tiene sesión, redirige al dashboard
        if (session('cliente_id')) {
            return redirect()->route('dashboard');
        }
        return view('registro');
    }

    public function register(Request $request) {
        $request->validate([
            'nombres'               => 'required|string|max:100',
            'apellidos'             => 'required|string|max:100',
            'telefono'              => 'nullable|string|max:20',
            'correo'                => 'required|email|unique:clientes,correo',
            'contrasena'            => 'required|min:8|confirmed',
        ], [
            'nombres.required'      => 'El nombre es obligatorio.',
            'apellidos.required'    => 'El apellido es obligatorio.',
            'correo.required'       => 'El correo es obligatorio.',
            'correo.unique'         => 'Este correo ya está registrado.',
            'contrasena.required'   => 'La contraseña es obligatoria.',
            'contrasena.min'        => 'La contraseña debe tener al menos 8 caracteres.',
            'contrasena.confirmed'  => 'Las contraseñas no coinciden.',
        ]);

        Cliente::create([
            'nombres'        => $request->nombres,
            'apellidos'      => $request->apellidos,
            'telefono'       => $request->telefono,
            'correo'         => $request->correo,
            'contrasena'     => Hash::make($request->contrasena),
            'rol'            => 'cliente',
            'fecha_registro' => now()->toDateString(),
        ]);

        return redirect()->route('login')
            ->with('success', '¡Cuenta creada! Ya puedes iniciar sesión.');
    }

    // LOGIN
    public function showLogin() {
        if (session('cliente_id')) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'correo'     => 'required|email',
            'contrasena' => 'required',
        ], [
            'correo.required'     => 'El correo es obligatorio.',
            'correo.email'        => 'Ingresa un correo válido.',
            'contrasena.required' => 'La contraseña es obligatoria.',
        ]);

        // Buscar cliente por correo
        $cliente = Cliente::where('correo', $request->correo)->first();

        // Verificar si existe y si la contraseña es correcta
        if (!$cliente || !Hash::check($request->contrasena, $cliente->contrasena)) {
            return back()
                ->withErrors(['correo' => 'Correo o contraseña incorrectos.'])
                ->withInput();
        }

        // Guardar datos en Session
        session([
            'cliente_id'       => $cliente->id,
            'cliente_nombres'  => $cliente->nombres,
            'cliente_apellidos'=> $cliente->apellidos,
            'cliente_correo'   => $cliente->correo,
            'cliente_rol'      => $cliente->rol,
        ]);

        // Cookie
        $response = redirect()->route('dashboard');
        if ($request->boolean('remember')) {
            $response->cookie('cosm_correo', $cliente->correo, 60 * 24 * 30);
        }

        return $response;
    }


    // LOGOUT
    public function logout() {
        session()->flush();
        return redirect()->route('inicio')
            ->withCookie(Cookie::forget('cosm_correo'));
    }
}
