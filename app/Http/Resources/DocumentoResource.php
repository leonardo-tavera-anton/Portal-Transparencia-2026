<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tipo' => $this->tipo,
            'anno' => $this->anno,
            'numero' => $this->numero,
            'fecha' => $this->fecha,
            'descripcion' => $this->descripcion,
            'codigo_completo' => $this->codigo_completo,

            'tipo_documento' => [
                'codigo' => $this->tipoDocumento->codigo ?? null,
                'nombre' => $this->tipoDocumento->nombre ?? null,
                'prefijo' => $this->tipoDocumento->prefijo ?? null,
            ],

            'anno_documento' => [
                'anno' => $this->annoDocumento->anno ?? null,
            ],

            'mantenimientos' => MantenimientoResource::collection(
                $this->whenLoaded('mantenimientos')
            ),
        ];
    }
}
