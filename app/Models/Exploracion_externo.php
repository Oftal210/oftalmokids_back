<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exploracion_externo extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'exploracion_externo';

    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primaryKey = 'cod_explo_exter';

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'cod_historia',
        'explo_exter_od',
        'explo_exter_os'
    ];

    // Relacion de los datos en el modelo, una exploracion externo tiene una historia clinica
    public function historiaClinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'cod_historia');
    }
}
