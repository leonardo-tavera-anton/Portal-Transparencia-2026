<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table = 'tipos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'prefijo',
        'estado',
    ];

    /**
     * Relación con la tabla documentos
     */
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'tipo', 'prefijo');
    }
}
