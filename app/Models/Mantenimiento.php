<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $table = 'mantenimiento';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'documento_id',
        'accion',
        'fecha',
        'descripcion',
        'link',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'documento_id', 'id');
    }
}
