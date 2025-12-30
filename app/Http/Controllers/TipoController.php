<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TipoService;
use App\Http\Resources\TipoResource;

class TipoController extends Controller
{
    protected $service;

    public function __construct(TipoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return TipoResource::collection($this->service->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'prefijo' => 'required',
            'estado' => 'required|boolean',
        ]);

        return new TipoResource($this->service->create($data));
    }

    public function show($id)
    {
        return new TipoResource($this->service->getById($id));
    }

    public function update(Request $request, $id)
    {
        return new TipoResource(
            $this->service->update($id, $request->all())
        );
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Categoría eliminada']);
    }
}
