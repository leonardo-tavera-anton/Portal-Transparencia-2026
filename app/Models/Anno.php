<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anno extends Model
{
    use HasFactory;

    protected $table = 'annos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'anno',
    ];

    /**
     * Relación con la tabla documentos
     */
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'anno', 'anno');
    }
}
