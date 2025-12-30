<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('username', $request->username)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            if (!$usuario->activo) {
                return back()->with('error', 'Su cuenta está desactivada. Contacte al administrador.');
            }

            session(['admin_id' => $usuario->id, 'admin_username' => $usuario->username]);
            return redirect()->route('admin.dashboard')->with('success', '¡Bienvenido!');
        }

        return back()->with('error', 'Credenciales incorrectas.')->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_username']);
        return redirect()->route('admin.login')->with('success', 'Sesión cerrada correctamente.');
    }
}
