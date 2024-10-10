<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente_visual extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'antecedente_visual';
    
    // Definimos el atributo de llave primaria de la tabla por si acaso 
    protected $primaryKey = 'cod_antece_visua';

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'cod_historia',
        'correc_optica',          
        'edad_lente_prim_vez',                       
        'cuant_cambio_rx',                       
        'motiv_cambio_rx',             
        'mater_tratam_optic',                      
        'indicaci_uso',                     
        'fech_ultim_exam'
    ];

    // Relacion de los datos en el modelo, un antecedente visual solo tiene una historia clinica
    public function histo_clinica(){
        return $this->belongsTo(Historia_clinica::class, 'cod_historia');
    }
}
