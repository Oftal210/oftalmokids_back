<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preconsulta extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'preconsulta';

    // Si la clave primaria no es un incremento automático
    public $incrementing = false;

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'id_hijo', 
        'uso_gaf_lente', 
        'motiv_uso_gaf', 
        'uso_medicam', 
        'motiv_uso_medicam',
        'limit_pantalla',
        'motiv_limit_pantalla',
        'activid_air_libre',
        'motiv_acti_libre',
        'buena_aliment',
        'motiv_bue_alimen',
        'solicit_control',
        'motiv_soli_control',
        'puntua_preconsul',
        'fecha_preconsul'
    ];


    // Relacion de los datos en el modelo, una consulta solo tiene 1 hijo
    public function hijoPreCon(){
        return $this->belongsTo(Hijo::class, 'id_hijo');
    }


}