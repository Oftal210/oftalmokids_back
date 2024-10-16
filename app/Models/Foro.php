<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'foro';

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;


    protected $fillable = [
        'id_usuario',
        'subtitulo_foro',
        'contenido_foro'
    ];


    // Relacion de los datos en el modelo, un foro tiene un usuario
    public function rol(){
        return $this->belongsTo(User::class, 'id');
    }
}