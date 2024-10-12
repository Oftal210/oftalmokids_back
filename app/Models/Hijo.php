<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hijo extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'hijo';

    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primaryKey = 'id_hijo';

    // Si la clave primaria no es un incremento automático
    public $incrementing = false;

    // Desactivar los timestamps automáticos, es decir atributos para controlar cuando se inserto o actualizo un dato
    public $timestamps = false;

    protected $fillable = [
        'id_hijo',
        'id_usuario', 
        'nom_hijo', 
        'ape_hijo', 
        'tip_doc_hijo', 
        'fech_nac_hijo',
        'foto_hijo'
    ];


    // Relacion de los datos en el modelo, un hijo puede tener solo un usuario (padre)
    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relacion de los datos en el modelo, un hijo puede tener varias consultas
    public function preconsultas(){
        return $this->hasMany(Preconsulta::class, 'cod_preconsul');
    }

    // Relacion de los datos en el modelo, un hijo tiene una sola historia clinica
    public function historiaClinica()
    {
        return $this->belongsTo(Historia_clinica::class, 'cod_historia');
    }
}