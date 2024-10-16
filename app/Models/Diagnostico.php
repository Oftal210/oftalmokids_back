<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'diagnostico';
    

    // Si la clave primaria no es un incremento automático
    public $incrementing = false;

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'descripcion'
    ];


    // Relacion de los datos en el modelo, un diagnostico puede tener diagnosticos x historia clinica
    public function diag_hist_cli(){
        return $this->hasMany(Hijo::class, 'cod_diag_his');
    }
}
