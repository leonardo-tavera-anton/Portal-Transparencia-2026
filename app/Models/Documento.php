<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'tipo',
        'anno',
        'numero',
        'fecha',
        'descripcion',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Relación con la tabla mantenimiento
     */
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'documento_id', 'id');
    }

    /**
     * Relación con la tabla tipos
     */
    public function tipoDocumento()
    {
        return $this->belongsTo(Tipo::class, 'tipo', 'prefijo');
    }

    /**
     * Relación con la tabla annos
     */
    public function annoDocumento()
    {
        return $this->belongsTo(Anno::class, 'anno', 'anno');
    }

    /**
     * Obtener el código completo del documento (AC-2-2023)
     */
    public function getCodigoCompletoAttribute()
    {
        return $this->tipo . '-' . $this->numero . '-' . $this->anno;
    }
}
