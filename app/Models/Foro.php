<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'foro';

    protected $fillable = [
        'id_usuario',
        'subtitulo_foro',
        'contenido_foro',
        'ruta_imagen',
        'fecha_vencimiento'
    ];


    // Relacion de los datos en el modelo, un foro tiene un usuario
    public function rol(){
        return $this->belongsTo(User::class, 'id');
    }

    // Relacion de los datos en el modelo, un foro puede tener varios likes
    public function likes()
    {
        return $this->hasMany(Foro_like::class, 'id_foro');
    }

    public function notificaciones()
    {
        return $this->hasMany(Foro_like::class, 'id_foro');
    }
}