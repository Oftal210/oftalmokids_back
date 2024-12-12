<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alineamiento_motor extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'alineamiento_motor';

    protected $fillable = [
        'id_historia',
        'angulo_kapa',
        'test_hirschberg',
        'test_bruckner',
        'covet_test_vl',
        'covet_test_vp',
        'esta_acomo_flex_od',
        'esta_acomo_flex_os',
        'esta_acomo_aa_od',
        'esta_acomo_aa_os',
    ];

    // Relacion de los datos en el modelo, un alineamiento motor tiene una historia clinica
    public function historiaClinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'id_historia');
    }
}
