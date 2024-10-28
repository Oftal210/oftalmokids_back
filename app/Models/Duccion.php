<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duccion extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'duccion';

    protected $fillable = [
        'id_historia',
        'ducc_normal_od',
        'ducc_parecia_od',
        'ducc_paralisis_od',
        'ducc_normal_os',
        'ducc_parecia_os',
        'ducc_paralisis_os'
    ];

    // Relacion de los datos en el modelo, una duccion tiene un historia clinica
    public function histo_clinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'id_historia');
    }
}
