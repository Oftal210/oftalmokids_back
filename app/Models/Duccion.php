<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duccion extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'duccion';

    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primaryKey = 'cod_ducciones';

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'cod_historia',
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
        return $this->belongsTo(Historia_clinica::class, 'cod_historia');
    }
}
