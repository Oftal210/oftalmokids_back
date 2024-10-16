<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // INSERTAMOS LOS ROLES NECESARIOS PARA EL FUNCIONAMIENTO CORRECTO DE LOS USUARIOS
        DB::table('rol')->insert([
            [
                'cod_rol' => 1,
                'nom_rol' => 'superadmin',
            ],
            [
                'cod_rol' => 2,
                'nom_rol' => 'padre',
            ]
        ]);
    }
}
