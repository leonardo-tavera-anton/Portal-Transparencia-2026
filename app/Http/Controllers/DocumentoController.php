<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentoService;
use App\Http\Resources\DocumentoResource;

class DocumentoController extends Controller
{
    protected $service;

    public function __construct(DocumentoService $service)
    {
        $this->service = $service;
    }

    /**
     * Listar documentos (con filtros)
     * Categoria (tipo), año, palabras clave
     */
    public function index(Request $request)
    {
        $query = \App\Models\Documento::query()
            ->with(['tipoDocumento', 'annoDocumento']);

        // Filtro por categoría (antes tipo)
        if ($request->filled('categoria')) {
            $query->where('tipo', $request->categoria);
        }

        // Filtro por año
        if ($request->filled('anno')) {
            $query->where('anno', $request->anno);
        }

        // Filtro por palabras clave
        if ($request->filled('search')) {
            $query->where('descripcion', 'like', '%' . $request->search . '%');
        }

        $documentos = $query->orderBy('anno', 'desc')
                            ->orderBy('numero', 'desc')
                            ->get();

        return DocumentoResource::collection($documentos);
    }

    /**
     * Ver detalle de un documento
     */
    public function show($id)
    {
        $documento = $this->service->getById($id);
        return new DocumentoResource($documento);
    }

    /**
     * Crear documento
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo' => 'required',
            'anno' => 'required|integer',
            'numero' => 'required|integer',
            'fecha' => 'nullable|date',
            'descripcion' => 'required|string',
        ]);

        $documento = $this->service->create($data);

        return new DocumentoResource($documento);
    }

    /**
     * Actualizar documento
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'tipo',
            'anno',
            'numero',
            'fecha',
            'descripcion',
        ]);

        $documento = $this->service->update($id, $data);

        return new DocumentoResource($documento);
    }

    /**
     * Eliminar documento
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Documento eliminado']);
    }
}
