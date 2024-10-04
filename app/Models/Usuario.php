<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Usuario extends Model
{
    use HasFactory, HasApiTokens;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'usuario';

    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primaryKey = 'id_usuario';

    // Si la clave primaria no es un incremento automático
    public $incrementing = false;

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'cod_rol',
        'nom_usuario',
        'ape_usuario',
        'email_usuario',
        'tele_usuario',
        'cont_usuario'
    ];


    // Relacion de los datos en el modelo, un solo rol por usuario
    public function rol(){
        return $this->belongsTo(Rol::class, 'cod_rol');
    }
}
