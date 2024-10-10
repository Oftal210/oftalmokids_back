<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico_historia_clinica extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'diagnostico_historia_clinica';
    
    // Definimos el atributo de llave primaria de la tabla por si acaso 
    protected $primaryKey = 'cod_diag_his';

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'cod_diagnostico',
        'cod_historia',
        'motivo_consulta',
        'tratam_diag_his',
        'pronos_diag_his', 
        'control_diag_his', 
        'hora_fecha_diag'
    ];

    // Relacion de los datos en el modelo, una diagnostico x historia clinica tiene un diagnostico
    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class, 'cod_diagnostico');
    }

    // Relacion de los datos en el modelo, una diagnostico x historia clinica tiene una historia clinica
    public function histo_clinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'cod_historia');
    }
}
