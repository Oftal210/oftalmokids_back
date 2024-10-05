<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'padre';


    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primaryKey = 'id_padre';

    // Si la clave primaria no es un incremento automático
    public $incrementing = false;

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'id_padre',
        'nom_padre', 
        'ape_padre', 
        'tele_padre', 
        'email_padre', 
        'cont_padre'
    ];


    // Relacion de los datos en el modelo, un padre puede tener varios hijos
    public function hijos(){
        return $this->hasMany(Hijo::class, 'id_hijo');
    }
}
