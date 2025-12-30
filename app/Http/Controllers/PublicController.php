<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Tipo;
use App\Models\Anno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Documento::with(['tipoDocumento', 'annoDocumento'])
                         ->where('publicado', true);

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
                           ->orderBy('fecha', 'desc')
                           ->paginate($request->input('per_page', 20))
                           ->withQueryString();

        $tipos = Tipo::where('estado', true)->orderBy('nombre')->get();
        $annos = Anno::orderBy('anno', 'desc')->get();

        return view('public.index', compact('documentos', 'tipos', 'annos'));
    }

    public function download($id)
    {
        $documento = Documento::where('publicado', true)->findOrFail($id);
        
        if (!Storage::disk('documentos')->exists($documento->archivo_path)) {
            abort(404, 'Archivo no encontrado');
        }

        return Storage::disk('documentos')->download($documento->archivo_path);
    }

    public function view($id)
    {
        $documento = Documento::where('publicado', true)
                             ->with(['tipoDocumento', 'annoDocumento'])
                             ->findOrFail($id);
        
        if (!Storage::disk('documentos')->exists($documento->archivo_path)) {
            abort(404, 'Archivo no encontrado');
        }

        $path = Storage::disk('documentos')->path($documento->archivo_path);
        return response()->file($path);
    }
}
