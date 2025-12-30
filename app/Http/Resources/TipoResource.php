<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'prefijo' => $this->prefijo,
            'estado' => $this->estado,
        ];
    }
}
