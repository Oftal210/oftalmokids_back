<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'codigo';

    
    // Definimos el atributo de llave primaria de la tabla por si acaso 
    protected $primarykey = 'cod_codigo';


    protected $fillable = [
        'nom_codigo',
        'descrip_codigo'
    ];
}
