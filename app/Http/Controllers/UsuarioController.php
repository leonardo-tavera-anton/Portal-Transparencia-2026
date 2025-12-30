<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsuarioService;
use App\Http\Resources\UsuarioResource;

class UsuarioController extends Controller
{
    protected $service;

    public function __construct(UsuarioService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return UsuarioResource::collection($this->service->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        return new UsuarioResource($this->service->create($data));
    }
}
