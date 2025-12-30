<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MantenimientoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'documento_id' => $this->documento_id,
            'accion' => $this->accion,
            'fecha' => $this->fecha,
            'descripcion' => $this->descripcion,
            'link' => $this->link,

            'documento' => [
                'codigo_completo' => $this->documento->codigo_completo ?? null,
                'descripcion' => $this->documento->descripcion ?? null,
            ],
        ];
    }
}
