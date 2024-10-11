<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Rol extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'rol';


    // Definimos los datos que se van a poder e
    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    // Relacion de los datos en el modelo
    public function usuarios(){
        return $this->hasMany(User::class, 'id_usuario');
    }
}
