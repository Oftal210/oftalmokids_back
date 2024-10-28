<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agudeza_visual extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'agudeza_visual';

    protected $fillable = [
        'id_historia',
        'agude_visu_test',
        'agude_visu_distan', 
        'od_sc_vl',
        'od_vp',
        'od_ph',
        'os_sc_vl',
        'os_vp',
        'os_ph',
        'lensome_od',
        'lensome_os',
        'od_cc_vl',
        'od_vp_lenso',
        'os_cc_vl',
        'os_vp_lenso',
        'queratome_od',
        'queratome_os'
    ];


    // Relacion de los datos en el modelo, un diagnostico puede tener diagnosticos x historia clinica
    public function histo_clinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'id_historia');
    }
}
