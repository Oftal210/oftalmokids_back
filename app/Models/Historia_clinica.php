<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia_clinica extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla como aparece en la base de datos
    protected $table = 'historia_clinica';


    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primarykey = 'cod_historia';


    protected $fillable = [
        'id_hijo',
        'id_padre',
        'id_usuario',
        'fech_consulta',
        'motivo_consulta',
        'edad_embar_madre',
        'alto_riesgo',
        'especif_riesg',
        'semanas_gestacion',
        'tipo_parto',
        'complicacion',
        'especif_compli',
        'uso_incubadora',
        'tiempo_incubadora',
        'apgar_incubadora',
        'respir_lloro_nacer',
        'enferme_embarazo',
        'especif_enferme_embar',
        'medicam_embarazo',
        'especif_medicam_embar',
        'enferm_sistemica',
        'especif_enferm_sistemica',
        'alergia',
        'especif_alergia',
        'cirug_gener_ocular',
        'correc_optica',
        'edad_lente_prim_vez',
        'cuant_cambio_rx',
        'motiv_cambio_rx',
        'mater_tratam_optic',
        'indicaci_uso',
        'fech_ultim_exam',
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
        'queratome_os',
        'retino_tecnica',
        'retino_ciclople',
        'retino_refrac_od',
        'retino_refrac_os',
        'retino_subjet_od',
        'retino_subjet_os',
        'retino_final_od',
        'retino_final_os',
        'test_hirschberg',
        'test_bruckner',
        'angulo_kappa',
        'covet_test_vl',
        'covet_test_vp',
        'esta_acomo_flex',
        'esta_acomo_aa',
        'versi_observaci',
        'ducc_normal_od',
        'ducc_parecia_od',
        'ducc_paralisis_od',
        'ducc_normal_os',
        'ducc_parecia_os',
        'ducc_paralisis_os',
        'mo_seguimiento_od',
        'mo_sacadicos_od',
        'mo_seguimiento_os',
        'mo_sacadicos_os',
        'mo_seguimiento_ao',
        'mo_sacadicos_ao',
        'explo_exter_od',
        'explo_exter_os',
        'medi_refrin_od',
        'refle_fovea_od',
        'papila_od',
        'excav_fisio_od',
        'profundidad_od',
        'vasos_od',
        'rela_arte_od',
        'macula_od',
        'reti_perif_od',
        'medi_refrin_os',
        'refle_fovea_os',
        'papila_os',
        'excav_fisio_os',
        'profundidad_os',
        'vasos_os',
        'rela_arte_os',
        'macula_os',
        'reti_perif_os',
        'diagnostico',
        'pronostico',
        'tratamiento',
        'control_historia_cli'
    ];


    // Relacion de los datos en el modelo, una historia tiene un hijo
    public function hijoHisCli()
    {
        return $this->belongsTo(Hijo::class, 'id_hijo');
    }

    // Relacion de los datos en el modelo, una historia tiene un padre
    public function padreHisCli()
    {
        return $this->belongsTo(Padre::class, 'id_padre');
    }

    // Relacion de los datos en el modelo, una historia tiene un usuario
    public function usuarioHisCli()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
