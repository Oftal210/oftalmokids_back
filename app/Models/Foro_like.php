<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro_like extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'foro_like';

    // variable para definir que datos se vana  modifcar
    protected $fillable = [
        'id_usuario',
        'id_foro'
    ];

    // Relacion de los datos en el modelo, un hijo puede tener solo un usuario (padre)
    public function usuario(){
        return $this->belongsTo(User::class);
    }

    // Relacion de los datos en el modelo, un hijo puede tener solo un usuario (padre)
    public function foro(){
        return $this->belongsTo(Foro::class);
    }
}
