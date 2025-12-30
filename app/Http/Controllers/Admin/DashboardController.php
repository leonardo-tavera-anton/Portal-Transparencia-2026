<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\Tipo;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_documentos' => Documento::count(),
            'documentos_publicados' => Documento::where('publicado', true)->count(),
            'total_categorias' => Tipo::where('estado', true)->count(),
            'total_usuarios' => Usuario::where('activo', true)->count(),
        ];

        $documentos_recientes = Documento::with(['tipoDocumento', 'annoDocumento'])
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'documentos_recientes'));
    }
}
