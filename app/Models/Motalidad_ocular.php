<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motalidad_ocular extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'motalidad_ocular';

    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primaryKey = 'cod_motali_ocular';

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'cod_historia',
        'mo_seguimiento_od',
        'mo_sacadicos_od',
        'mo_seguimiento_os',
        'mo_sacadicos_os',
        'mo_seguimiento_ao',
        'mo_sacadicos_ao'
    ];

    // Relacion de los datos en el modelo, un hijo tiene una sola historia clinica
    public function histo_clinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'cod_historia');
    }
}
