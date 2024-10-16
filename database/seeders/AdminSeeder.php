<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // INSERTAMOS EL USUARIO ADMIN
        DB::table('users')->insert([
            'documento' => '1234567890',
            'contrasena' => Hash::make('1234'),
            'nombre' => 'SuperAdmin',
            'apellido' => 'SuperAdmin',
            'email' => 'sp@gmail.com',
            'telefono' => '3214105689',
            'id_rol' => 1
        ]);
    }
}
