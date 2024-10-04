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


    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primarykey = 'cod_rol';


    // Definimos los datos que se van a poder e
    protected $fillable = [
        'nom_rol'
    ];


    // Relacion de los datos en el modelo
    public function usuarios(){
        return $this->hasMany(Usuario::class, 'id_usuario');
    }
}
