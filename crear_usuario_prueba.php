<?php

use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

// Crear usuario de prueba
$usuario = new Usuario();
$usuario->username = 'usuario_prueba';
$usuario->password = Hash::make('password123');
$usuario->activo = true;
$usuario->save();

echo "Usuario creado exitosamente!\n";
echo "ID: {$usuario->id}\n";
echo "Username: {$usuario->username}\n";
echo "Activo: " . ($usuario->activo ? 'Sí' : 'No') . "\n";
