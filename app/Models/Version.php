<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'version';

    protected $fillable = [
        'id_historia',
        'observacion',
        'rsd_oii',
        'rld_rmi',
        'rid_osi',
        'oid_rsi',
        'rmd_rli',
        'osd_rii',
    ];

    // Relacion de los datos en el modelo, una version tiene una historia clinica
    public function histo_clinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'id_historia');
    }
}
