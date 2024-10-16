<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente_visual extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'antecedente_visual';
    

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'id_historia',
        'correcion_optica',          
        'edad_lentes_prim_vez',                       
        'cuantos_cambio_rx',                       
        'motivo_cambio_rx',             
        'material_tratam_optic',                      
        'indicacion_uso',                     
        'fecha_ultimo_examen'
    ];

    // Relacion de los datos en el modelo, un antecedente visual solo tiene una historia clinica
    public function histo_clinica(){
        return $this->belongsTo(Historia_clinica::class, 'id_historia');
    }
}
