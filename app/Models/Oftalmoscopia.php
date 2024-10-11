<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oftalmoscopia extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'oftalmoscopia';

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'id_historia',
        'medi_refrin_od',
        'refle_fovea_od',
        'papila_od',
        'excav_fisio_od',
        'profundidad_od',
        'vasos_od',
        'rela_arte_od',
        'macula_od',
        'reti_perif_od',
        'medi_refrin_os',
        'refle_fovea_os',
        'papila_os',
        'excav_fisio_os',
        'profundidad_os',
        'vasos_os',
        'rela_arte_os',
        'macula_os',
        'reti_perif_os'
    ];

    // Relacion de los datos en el modelo, una oftalmoscopia tiene una historia clinica
    public function historiaClinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'id_historia');
    }
}
