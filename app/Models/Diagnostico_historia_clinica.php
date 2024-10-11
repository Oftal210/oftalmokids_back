<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico_historia_clinica extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'diagnostico_historia_clinica';
    

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'id_historia',
        'motivo_consulta',
        'tratamiento',
        'pronostico', 
        'control', 
        'fecha'
    ];

    // Relacion de los datos en el modelo, una diagnostico x historia clinica tiene un diagnostico
    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class, 'id_diagnostico');
    }

    // Relacion de los datos en el modelo, una diagnostico x historia clinica tiene una historia clinica
    public function histo_clinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'id_historia');
    }
}
