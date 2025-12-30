<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function index()
    {
        $tipos = Tipo::orderBy('nombre')->get();
        return view('admin.tipos.index', compact('tipos'));
    }

    public function create()
    {
        return view('admin.tipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:20|unique:tipos,codigo',
            'nombre' => 'required|string|max:100',
            'prefijo' => 'required|string|max:10|unique:tipos,prefijo',
        ]);

        Tipo::create([
            'codigo' => strtoupper($request->codigo),
            'nombre' => $request->nombre,
            'prefijo' => strtoupper($request->prefijo),
            'estado' => true,
        ]);

        return redirect()->route('admin.tipos.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function edit($id)
    {
        $tipo = Tipo::findOrFail($id);
        return view('admin.tipos.edit', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $tipo = Tipo::findOrFail($id);

        $request->validate([
            'codigo' => 'required|string|max:20|unique:tipos,codigo,' . $id,
            'nombre' => 'required|string|max:100',
            'prefijo' => 'required|string|max:10|unique:tipos,prefijo,' . $id,
        ]);

        $tipo->update([
            'codigo' => strtoupper($request->codigo),
            'nombre' => $request->nombre,
            'prefijo' => strtoupper($request->prefijo),
        ]);

        return redirect()->route('admin.tipos.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function toggleStatus($id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->estado = !$tipo->estado;
        $tipo->save();

        $mensaje = $tipo->estado ? 'Categoría activada' : 'Categoría desactivada';
        return redirect()->route('admin.tipos.index')->with('success', $mensaje);
    }
}
