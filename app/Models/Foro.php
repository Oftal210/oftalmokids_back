<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'foro';


    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primarykey = 'cod_foro';


    protected $fillable = [
        'subtitulo_foro',
        'contenido_foro'
    ];
}
