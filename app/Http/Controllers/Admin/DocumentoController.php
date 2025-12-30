<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\Tipo;
use App\Models\Anno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index(Request $request)
    {
        $query = Documento::with(['tipoDocumento', 'annoDocumento']);

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('anno')) {
            $query->where('anno', $request->anno);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('numero', 'like', '%' . $request->search . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->search . '%');
            });
        }

        $documentos = $query->orderBy('anno', 'desc')
                           ->orderBy('numero', 'desc')
                           ->paginate($request->input('per_page', 20))
                           ->withQueryString();

        $tipos = Tipo::where('estado', true)->orderBy('nombre')->get();
        $annos = Anno::orderBy('anno', 'desc')->get();

        return view('admin.documentos.index', compact('documentos', 'tipos', 'annos'));
    }

    public function create()
    {
        $tipos = Tipo::where('estado', true)->orderBy('nombre')->get();
        $annos = Anno::orderBy('anno', 'desc')->get();
        return view('admin.documentos.create', compact('tipos', 'annos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|exists:tipos,prefijo',
            'numero' => 'required|string|max:10',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
            'archivo' => 'required|file|mimes:pdf|max:10240',
        ]);

        // Obtener el año de la fecha del documento
        $anno = date('Y', strtotime($request->fecha));

        // Verificar si ya existe el documento
        $existe = Documento::where('tipo', $request->tipo)
                          ->where('numero', $request->numero)
                          ->where('anno', $anno)
                          ->exists();

        if ($existe) {
            return back()->withInput()->with('error', 'Ya existe un documento con este número y tipo en el año ' . $anno);
        }

        // Crear año si no existe
        Anno::firstOrCreate(['anno' => $anno]);

        // Generar nombre del archivo: PREFIJO_NUMERO-AÑO-MDNCH.pdf
        $numero_formateado = str_pad($request->numero, 3, '0', STR_PAD_LEFT);
        $nombre_archivo = $request->tipo . '_' . $numero_formateado . '-' . $anno . '-MDNCH.pdf';

        // Crear estructura de carpetas: categoria/año/
        $tipo_obj = Tipo::where('prefijo', $request->tipo)->first();
        $carpeta = $tipo_obj->codigo . '/' . $anno;

        // Guardar archivo
        $archivo = $request->file('archivo');
        $ruta = $archivo->storeAs($carpeta, $nombre_archivo, 'documentos');

        // Crear documento
        Documento::create([
            'tipo' => $request->tipo,
            'anno' => $anno,
            'numero' => $request->numero,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'archivo_path' => $ruta,
            'publicado' => true,
        ]);

        return redirect()->route('admin.documentos.index')->with('success', 'Documento creado exitosamente.');
    }

    public function edit($id)
    {
        $documento = Documento::with(['tipoDocumento', 'annoDocumento'])->findOrFail($id);
        $tipos = Tipo::where('estado', true)->orderBy('nombre')->get();
        return view('admin.documentos.edit', compact('documento', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $documento = Documento::findOrFail($id);

        $request->validate([
            'tipo' => 'required|exists:tipos,prefijo',
            'numero' => 'required|string|max:10',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Verificar duplicados (excluyendo el actual)
        $existe = Documento::where('tipo', $request->tipo)
                          ->where('numero', $request->numero)
                          ->where('anno', $documento->anno)
                          ->where('id', '!=', $id)
                          ->exists();

        if ($existe) {
            return back()->withInput()->with('error', 'Ya existe otro documento con este número y tipo en el año ' . $documento->anno);
        }

        $datos = [
            'tipo' => $request->tipo,
            'numero' => $request->numero,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
        ];

        // Si se sube nuevo archivo, reemplazar el anterior
        if ($request->hasFile('archivo')) {
            // Eliminar archivo anterior
            if ($documento->archivo_path && Storage::disk('documentos')->exists($documento->archivo_path)) {
                Storage::disk('documentos')->delete($documento->archivo_path);
            }

            // Generar nuevo nombre
            $numero_formateado = str_pad($request->numero, 3, '0', STR_PAD_LEFT);
            $nombre_archivo = $request->tipo . '_' . $numero_formateado . '-' . $documento->anno . '-MDNCH.pdf';

            // Crear carpeta
            $tipo_obj = Tipo::where('prefijo', $request->tipo)->first();
            $carpeta = $tipo_obj->codigo . '/' . $documento->anno;

            // Guardar nuevo archivo
            $archivo = $request->file('archivo');
            $ruta = $archivo->storeAs($carpeta, $nombre_archivo, 'documentos');

            $datos['archivo_path'] = $ruta;
        }

        $documento->update($datos);

        return redirect()->route('admin.documentos.index')->with('success', 'Documento actualizado exitosamente.');
    }

    public function togglePublicado($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->publicado = !$documento->publicado;
        $documento->save();

        $mensaje = $documento->publicado ? 'Documento publicado' : 'Documento despublicado';
        return redirect()->route('admin.documentos.index')->with('success', $mensaje);
    }

    public function download($id)
    {
        $documento = Documento::findOrFail($id);
        
        if (!Storage::disk('documentos')->exists($documento->archivo_path)) {
            abort(404, 'Archivo no encontrado');
        }

        return Storage::disk('documentos')->download($documento->archivo_path);
    }
}
