<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia_clinica extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'historia_clinica';

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;


    protected $fillable = [
        'id_hijo',
        'id_usuario',
        'edad_embarazo',
        'alto_riesgo',
        'especificar_riesgo',
        'semanas_gestacion',
        'tipo_parto',
        'complicacion',
        'especificar_compli',
        'uso_incubadora',
        'tiempo_incubadora',
        'apgar_incubadora',
        'respiro_lloro_nacer',
        'enfermedades_embarazo',
        'especificar_enfermedades',
        'medicamento_embarazo',
        'especificar_medicamento',
        'enfermedad_sistemica',
        'especif_enferm_sistemica',
        'alergia',
        'especificar_alergia',
        'cirugia_ocular'
    ];


    // Relacion de los datos en el modelo, una historia tiene un hijo
    public function hijoHisCli()
    {
        return $this->belongsTo(Hijo::class, 'id_hijo');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varios diagnostico x historia clinica
    public function diag_his_cli(){
        return $this->hasMany(Diagnostico_historia_clinica::class, 'cod_diag_his');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varios antecedentes visuales
    public function antece_visual(){
        return $this->hasMany(Antecedente_visual::class, 'cod_antece_visua');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varias agudeza visual
    public function agudeza_visual(){
        return $this->hasMany(Agudeza_visual::class, 'cod_agude_visua');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varias retinoscopia
    public function retinoscopia(){
        return $this->hasMany(Retinoscopia::class, 'cod_retinoscopia');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varios alineamiento motor
    public function alinea_motor(){
        return $this->hasMany(Alineamiento_motor::class, 'cod_alinea_motor');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varias version
    public function versiones(){
        return $this->hasMany(Version::class, 'cod_versiones');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varias duccion
    public function ducciones(){
        return $this->hasMany(Duccion::class, 'cod_ducciones');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varias motalidad ocular
    public function motal_ocular(){
        return $this->hasMany(Motalidad_ocular::class, 'cod_motali_ocular');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varias exploracion externo
    public function explo_exter(){
        return $this->hasMany(Exploracion_externo::class, 'cod_explo_exter');
    }

    // Relacion de los datos en el modelo, una historia clinica puede tener varias oftalmoscopia
    public function oftalmoscopia(){
        return $this->hasMany(Oftalmoscopia::class, 'cod_oftalmoscopia');
    }

}
