<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Mutator para encriptar la contraseña automáticamente
     */
    public function setPasswordAttribute($value)
    {
        // Solo encriptar si no está vacío y no es un hash bcrypt
        if (!empty($value) && !Str::startsWith($value, '$2y$')) {
            $this->attributes['password'] = bcrypt($value);
        } elseif (!empty($value)) {
            $this->attributes['password'] = $value;
        }
    }
}
