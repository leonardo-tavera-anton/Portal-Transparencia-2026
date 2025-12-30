<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador por defecto
        DB::table('usuarios')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'activo' => true,
        ]);

        // Crear año actual
        DB::table('annos')->insert([
            'anno' => date('Y'),
        ]);

        // Crear categorías de documentos de ejemplo
        $tipos = [
            ['codigo' => 'ORD', 'nombre' => 'Ordenanza Municipal', 'prefijo' => 'OM', 'estado' => true],
            ['codigo' => 'ACU', 'nombre' => 'Acuerdo de Concejo', 'prefijo' => 'AC', 'estado' => true],
            ['codigo' => 'RES', 'nombre' => 'Resolución de Alcaldía', 'prefijo' => 'RA', 'estado' => true],
            ['codigo' => 'DEC', 'nombre' => 'Decreto de Alcaldía', 'prefijo' => 'DA', 'estado' => true],
        ];

        foreach ($tipos as $tipo) {
            DB::table('tipos')->insert($tipo);
        }
    }
}
