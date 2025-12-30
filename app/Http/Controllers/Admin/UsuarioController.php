<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('username')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:usuarios,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Usuario::create([
            'username' => $request->username,
            'password' => $request->password,
            'activo' => true,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:50|unique:usuarios,username,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $datos = [
            'username' => $request->username,
        ];

        // Solo actualizar password si se envió uno nuevo
        if ($request->filled('password')) {
            $datos['password'] = bcrypt($request->password);
        }

        // Actualizar directamente con DB para evitar el mutador
        DB::table('usuarios')
            ->where('id', $id)
            ->update($datos);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function toggleStatus($id)
    {
        $usuario = Usuario::findOrFail($id);
        
        // Evitar desactivar el propio usuario
        if ($usuario->id == session('admin_id')) {
            return redirect()->route('admin.usuarios.index')->with('error', 'No puede desactivar su propia cuenta.');
        }

        $usuario->activo = !$usuario->activo;
        $usuario->save();

        $mensaje = $usuario->activo ? 'Usuario activado' : 'Usuario desactivado';
        return redirect()->route('admin.usuarios.index')->with('success', $mensaje);
    }
}
