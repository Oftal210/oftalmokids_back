<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class PadreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // INSERTAMOS EL USUARIO PADRE
        DB::table('users')->insert([
            'documento' => '1234567899',
            'contrasena' => Hash::make('1234'),
            'nombre' => 'Padre',
            'apellido' => 'Padre',
            'email' => 'pp@gmail.com',
            'telefono' => '3214109856',
            'id_rol' => 2
        ]);
    }
}
