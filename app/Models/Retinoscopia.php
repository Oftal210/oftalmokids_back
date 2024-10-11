<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retinoscopia extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'retinoscopia';

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'id_historia',
        'retino_tecnica',
        'retino_ciclople',
        'retino_refrac_od',
        'retino_subjet_od',
        'retino_final_od',
        'retino_refrac_os',
        'retino_subjet_os',
        'retino_final_os'
    ];

    // Relacion de los datos en el modelo, una retinoscopia tiene una historia clinica
    public function histo_clinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'id_historia');
    }
}