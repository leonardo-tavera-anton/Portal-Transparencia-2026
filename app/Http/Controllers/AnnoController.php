<?php

namespace App\Http\Controllers;

use App\Services\AnnoService;
use App\Http\Resources\AnnoResource;

class AnnoController extends Controller
{
    protected $service;

    public function __construct(AnnoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return AnnoResource::collection($this->service->getAll());
    }
}

