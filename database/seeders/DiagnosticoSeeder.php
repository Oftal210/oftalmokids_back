<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DiagnosticoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //INSERTAMOS TODOS LOS DIAGNOSTICOS
        DB::table('diagnostico')->insert([
            ['codigo' => 'H00', 'descripcion' => 'Orzuelo y chalazion'],
            ['codigo' => 'H00.0', 'descripcion' => 'Orzuelo y otras inflamaciones profundas del párpado'],
            ['codigo' => 'H00.1', 'descripcion' => 'Chalazion'],

            ['codigo' => 'H01', 'descripcion' => 'Otras inflamaciones del párpado'],
            ['codigo' => 'H01.0', 'descripcion' => 'Blefaritis'],
            ['codigo' => 'H01.1', 'descripcion' => 'Dermatosis no infecciosa del párpado'],
            ['codigo' => 'H01.8', 'descripcion' => 'Otras inflamaciones especificadas del párpado'],
            ['codigo' => 'H01.9', 'descripcion' => 'Inflamación del párpado, no especificada'],

            ['codigo' => 'H02', 'descripcion' => 'Otros trastornos de los párpados'],
            ['codigo' => 'H02.0', 'descripcion' => 'Entropión y triquiasis palpebral'],
            ['codigo' => 'H02.1', 'descripcion' => 'Ectropión del párpado'],
            ['codigo' => 'H02.2', 'descripcion' => 'Lagoftalmos'],
            ['codigo' => 'H02.3', 'descripcion' => 'Blefarocalasia'],
            ['codigo' => 'H02.4', 'descripcion' => 'Blefaroptosis'],
            ['codigo' => 'H02.5', 'descripcion' => 'Otros trastornos funcionales del párpado'],
            ['codigo' => 'H02.6', 'descripcion' => 'Xantelasma del párpado'],
            ['codigo' => 'H02.7', 'descripcion' => 'Otros trastornos degenerativos del párpado y del área periocular'],
            ['codigo' => 'H02.8', 'descripcion' => 'Otros trastornos especificados del párpado'],
            ['codigo' => 'H02.9', 'descripcion' => 'Trastorno del párpado, no especificado'],
        
            ['codigo' => 'H03', 'descripcion' => 'Trastornos del párpado en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H03.0', 'descripcion' => 'Infección e infestación parasitarias del párpado en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H03.1', 'descripcion' => 'Compromiso del párpado en enfermedades infecciosas clasificadas en otra parte'],
            ['codigo' => 'H03.2', 'descripcion' => 'Compromiso del párpado en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H04', 'descripcion' => 'Trastornos del aparato lagrimal'],
            ['codigo' => 'H04.0', 'descripcion' => 'Dacrioadenitis'],
            ['codigo' => 'H04.1', 'descripcion' => 'Otros trastornos de la glándula lagrimal'],
            ['codigo' => 'H04.2', 'descripcion' => 'Epífora'],
            ['codigo' => 'H04.3', 'descripcion' => 'Inflamación aguda y las no especificadas en otra parte'],
            ['codigo' => 'H04.4', 'descripcion' => 'Inflamación crónica de las vías lagrimales'],
            ['codigo' => 'H04.5', 'descripcion' => 'Estenosis e insuficiencia de las vías lagrimales'],
            ['codigo' => 'H04.6', 'descripcion' => 'Otros cambios de las vías lagrimales'],
            ['codigo' => 'H04.8', 'descripcion' => 'Otros trastornos especificados del aparato lagrimal'],
            ['codigo' => 'H04.9', 'descripcion' => 'Trastorno del aparato lagrimal, no especificado'],

            ['codigo' => 'H05', 'descripcion' => 'Trastornos de la órbita'],
            ['codigo' => 'H05.0', 'descripcion' => 'Inflamación aguda de la órbita'],
            ['codigo' => 'H05.1', 'descripcion' => 'Trastornos inflamatorios crónicos de la órbita'],
            ['codigo' => 'H05.2', 'descripcion' => 'Afecciones exoftálmicas'],
            ['codigo' => 'H05.3', 'descripcion' => 'Deformidad de la órbita'],
            ['codigo' => 'H05.4', 'descripcion' => 'Enoftalmía'],
            ['codigo' => 'H05.5', 'descripcion' => 'Retención de cuerpo extraño, consecutiva a herida penetrante de la órbita'],
            ['codigo' => 'H05.8', 'descripcion' => 'Otros trastornos de la órbita'],
            ['codigo' => 'H05.9', 'descripcion' => 'Trastorno de la órbita, no especificado'],

            ['codigo' => 'H06', 'descripcion' => 'Trastornos del aparato lagrimal y de la órbita en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H06.0', 'descripcion' => 'Trastornos del aparato lagrimal en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H06.1', 'descripcion' => 'Infección e infestación parasitarias de la órbita en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H06.2', 'descripcion' => 'Exoftalmia hipertiroidea'],
            ['codigo' => 'H06.3', 'descripcion' => 'Otros trastornos de la órbita en enfermedades clasificadas en otra parte'],
        
            ['codigo' => 'H10', 'descripcion' => 'Conjuntivitis'],
            ['codigo' => 'H10.0', 'descripcion' => 'Conjuntivitis mucopurulenta'],
            ['codigo' => 'H10.1', 'descripcion' => 'Conjuntivitis atópica aguda'],
            ['codigo' => 'H10.2', 'descripcion' => 'Otras conjuntivitis agudas'],
            ['codigo' => 'H10.3', 'descripcion' => 'Conjuntivitis aguda, no especificada'],
            ['codigo' => 'H10.4', 'descripcion' => 'Conjuntivitis crónica'],
            ['codigo' => 'H10.5', 'descripcion' => 'Blefaroconjuntivitis'],
            ['codigo' => 'H10.8', 'descripcion' => 'Otras conjuntivitis'],
            ['codigo' => 'H10.9', 'descripcion' => 'Conjuntivitis, no especificada'],

            ['codigo' => 'H11', 'descripcion' => 'Otros trastornos de la conjuntiva'],
            ['codigo' => 'H11.0', 'descripcion' => 'Pterigión'],
            ['codigo' => 'H11.1', 'descripcion' => 'Degeneraciones y depósitos conjuntivales'],
            ['codigo' => 'H11.2', 'descripcion' => 'Cicatrices conjuntivales'],
            ['codigo' => 'H11.3', 'descripcion' => 'Hemorragia conjuntival'],
            ['codigo' => 'H11.4', 'descripcion' => 'Otros trastornos vasculares y quistes conjuntivales'],
            ['codigo' => 'H11.8', 'descripcion' => 'Otros trastornos especificados de la conjuntiva'],
            ['codigo' => 'H11.9', 'descripcion' => 'Trastorno de la conjuntiva, no especificado'],

            ['codigo' => 'H13', 'descripcion' => 'Trastornos de la conjuntiva en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H13.0', 'descripcion' => 'Infección filárica de la conjuntiva'],
            ['codigo' => 'H13.1', 'descripcion' => 'Conjuntivitis en enfermedades infecciosas parasitarias clasificadas en otra parte'],
            ['codigo' => 'H13.2', 'descripcion' => 'Conjuntivitis en otras enfermedades clasificadas en otra parte'],
            ['codigo' => 'H13.3', 'descripcion' => 'Penfigoide ocular'],
            ['codigo' => 'H13.8', 'descripcion' => 'Otros trastornos de la conjuntiva en enfermedades clasificadas en otra parte'],
        
            ['codigo' => 'H15', 'descripcion' => 'Trastornos de la esclerótica'],
            ['codigo' => 'H15.0', 'descripcion' => 'Escleritis'],
            ['codigo' => 'H15.1', 'descripcion' => 'Episcleritis'],
            ['codigo' => 'H15.8', 'descripcion' => 'Otros trastornos de la esclerótica'],
            ['codigo' => 'H15.9', 'descripcion' => 'Trastorno de la esclerótica, no especificado'],

            ['codigo' => 'H16', 'descripcion' => 'Queratitis'],
            ['codigo' => 'H16.0', 'descripcion' => 'Úlcera de córnea'],
            ['codigo' => 'H16.1', 'descripcion' => 'Otras queratitis superficiales sin conjuntivitis'],
            ['codigo' => 'H16.2', 'descripcion' => 'Queratoconjuntivitis'],
            ['codigo' => 'H16.3', 'descripcion' => 'Queratitis intersticial y profunda'],
            ['codigo' => 'H16.4', 'descripcion' => 'Neovascularización corneal'],

            ['codigo' => 'H17', 'descripcion' => 'Cicatrices y opacidades córneales'],

            ['codigo' => 'H18', 'descripcion' => 'Otros trastornos de la córnea'],
            ['codigo' => 'H18.0', 'descripcion' => 'Pigmentaciones y depósitos corneales'],
            ['codigo' => 'H18.1', 'descripcion' => 'Queratopatía bullosa'],
            ['codigo' => 'H18.2', 'descripcion' => 'Otros edemas corneales'],
            ['codigo' => 'H18.3', 'descripcion' => 'Cambios en membranas corneales'],
            ['codigo' => 'H18.4', 'descripcion' => 'Degeneración corneal'],
            ['codigo' => 'H18.5', 'descripcion' => 'Distrofias corneales hereditarias'],
            ['codigo' => 'H18.6', 'descripcion' => 'Queratocono'],
            ['codigo' => 'H18.7', 'descripcion' => 'Otras deformidades corneales'],
            ['codigo' => 'H18.8', 'descripcion' => 'Otros trastornos especificados de córnea'],
            ['codigo' => 'H18.9', 'descripcion' => 'Trastorno de córnea sin especificar'],

            ['codigo' => 'H19', 'descripcion' => 'Trastornos de la esclerótica y la córnea en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H19.0', 'descripcion' => 'Escleritis y Episcleritis en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H19.1', 'descripcion' => 'Queratitis y Queratoconjuntivitis herpesviral'],
            ['codigo' => 'H19.2', 'descripcion' => 'Queratitis y Queratoconjuntivitis en otras enfermedades infecciosas y parásitas'],
            ['codigo' => 'H19.3', 'descripcion' => 'Queratitis y Queratoconjuntivitis en otras enfermedades clasificadas en otra parte'],
            ['codigo' => 'H19.8', 'descripcion' => 'Otros trastornos de la esclerótica y la córnea en enfermedades clasificadas en otra parte'],
            ['codigo' => 'T15.0', 'descripcion' => 'Cuerpo extraño en córnea'],
        
        
            ['codigo' => 'H20', 'descripcion' => 'Iridociclitis'],
            ['codigo' => 'H20.0', 'descripcion' => 'Iridociclitis aguda y subaguda'],

            ['codigo' => 'H21', 'descripcion' => 'Otros trastornos del iris y del cuerpo ciliar'],
            ['codigo' => 'H21.0', 'descripcion' => 'Hifema'],
            ['codigo' => 'H21.1', 'descripcion' => 'Otros trastornos vasculares del iris y del cuerpo ciliar'],
            ['codigo' => 'H21.2', 'descripcion' => 'Degeneración del iris y el cuerpo ciliar'],
            ['codigo' => 'H21.3', 'descripcion' => 'Quiste del iris, del cuerpo ciliar y de la cámara anterior'],
            ['codigo' => 'H21.4', 'descripcion' => 'Membranas pupilares'],
            ['codigo' => 'H21.5', 'descripcion' => 'Otras adhesiones y disrupciones del iris y del cuerpo ciliar'],
            ['codigo' => 'H21.8', 'descripcion' => 'Otros trastornos especificados del iris y del cuerpo ciliar'],
            ['codigo' => 'H21.9', 'descripcion' => 'Uveítis'],

            ['codigo' => 'H22', 'descripcion' => 'Trastornos del iris y del cuerpo ciliar en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H25', 'descripcion' => 'Catarata senil'],

            ['codigo' => 'H26', 'descripcion' => 'Otras cataratas'],

            ['codigo' => 'H27', 'descripcion' => 'Otros trastornos del cristalino'],
            ['codigo' => 'H27.0', 'descripcion' => 'Afaquia'],
            ['codigo' => 'H27.1', 'descripcion' => 'Dislocación del cristalino'],

            ['codigo' => 'H28', 'descripcion' => 'Cataratas y otros trastornos del cristalino en enfermedades clasificadas en otra parte'],
            ['codigo' => 'Z96.1', 'descripcion' => 'Pseudofaquia'],

            ['codigo' => 'H30', 'descripcion' => 'Inflamación coriorretiniana'],

            ['codigo' => 'H31', 'descripcion' => 'Otros trastornos coroideos'],

            ['codigo' => 'H32', 'descripcion' => 'Trastornos coriorretinales en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H33', 'descripcion' => 'Desprendimiento de retina con ruptura'],
            ['codigo' => 'H33.1', 'descripcion' => 'Retinosquisis y quistes retinales'],

            ['codigo' => 'H34', 'descripcion' => 'Oclusiones vasculares retinales'],

            ['codigo' => 'H35', 'descripcion' => 'Otros trastornos retinianos'],
            ['codigo' => 'H35.0', 'descripcion' => 'Retinopatía de fondo y cambios vasculares retinales'],
            ['codigo' => 'H35.1', 'descripcion' => 'Retinopatía de la prematuridad'],
            ['codigo' => 'H35.3', 'descripcion' => 'Degeneración de la mácula y el polo posterior'],
            ['codigo' => 'H35.5', 'descripcion' => 'Distrofia hereditaria retiniana'],
            ['codigo' => 'H35.6', 'descripcion' => 'Hemorragia retiniana'],
            ['codigo' => 'H35.8', 'descripcion' => 'Otros trastornos de la retina especificados'],

            ['codigo' => 'H36', 'descripcion' => 'Trastornos retinianos en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H40', 'descripcion' => 'Glaucoma'],
            ['codigo' => 'H40.0', 'descripcion' => 'Glaucoma sospechoso'],
            ['codigo' => 'H40.1', 'descripcion' => 'Glaucoma primario de ángulo abierto'],
            ['codigo' => 'H40.2', 'descripcion' => 'Glaucoma primario de ángulo cerrado'],
            ['codigo' => 'H40.3', 'descripcion' => 'Glaucoma secundario por trauma ocular'],
            ['codigo' => 'H40.4', 'descripcion' => 'Glaucoma secundario por inflamación ocular'],
            ['codigo' => 'H40.5', 'descripcion' => 'Glaucoma secundario por otros trastornos ocular'],
            ['codigo' => 'H40.6', 'descripcion' => 'Glaucoma secundario por medicamentos'],

            ['codigo' => 'H42', 'descripcion' => 'Glaucoma en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H43', 'descripcion' => 'Trastornos del humor vítreo'],
            ['codigo' => 'H43.0', 'descripcion' => 'Prolapso vítreo'],
            ['codigo' => 'H43.1', 'descripcion' => 'Hemorragia vítrea'],
            ['codigo' => 'H43.2', 'descripcion' => 'Depósitos cristalinos en el humor vítreo'],
            ['codigo' => 'H43.3', 'descripcion' => 'Otras opacidades vítreas'],
            ['codigo' => 'H43.8', 'descripcion' => 'Otros trastornos del humor vítreo'],
            ['codigo' => 'H43.9', 'descripcion' => 'Trastorno del humor vítreo sin especificar'],

            ['codigo' => 'H44', 'descripcion' => 'Trastornos del globo ocular'],
            ['codigo' => 'H44.0', 'descripcion' => 'Endoftalmitis purulenta'],
            ['codigo' => 'H44.1', 'descripcion' => 'Otras endoftalmitis'],
            ['codigo' => 'H44.2', 'descripcion' => 'Miopía degenerativa'],
            ['codigo' => 'H44.3', 'descripcion' => 'Otros trastornos degenerativos del globo ocular'],
            ['codigo' => 'H44.4', 'descripcion' => 'Hipotonía ocular'],
            ['codigo' => 'H44.5', 'descripcion' => 'Enfermedades degenerativas del globo ocular'],
            ['codigo' => 'H44.6', 'descripcion' => 'Cuerpo extraño intraocular retenido (viejo) magnético'],
            ['codigo' => 'H44.7', 'descripcion' => 'Cuerpo extraño intraocular retenido (viejo) no-magnético'],
            ['codigo' => 'H44.8', 'descripcion' => 'Otros trastornos del globo ocular'],
            ['codigo' => 'H44.9', 'descripcion' => 'Trastorno del globo ocular sin especificar'],

            ['codigo' => 'H45', 'descripcion' => 'Trastornos del cuerpo vítreo y el globo ocular en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H46', 'descripcion' => 'Neuritis óptica'],

            ['codigo' => 'H47', 'descripcion' => 'Otros trastornos del segundo nervio óptico y los campos visuales'],
            ['codigo' => 'H47.1', 'descripcion' => 'Papiledema sin especificar'],
            ['codigo' => 'H47.2', 'descripcion' => 'Atrofia óptica'],

            ['codigo' => 'H48', 'descripcion' => 'Trastornos del segundo nervio óptico y los campos visuales en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H49', 'descripcion' => 'Estrabismo paralítico'],
            ['codigo' => 'H49.0', 'descripcion' => 'Parálisis del tercer par craneal (motor ocular común)'],
            ['codigo' => 'H49.1', 'descripcion' => 'Parálisis del cuarto par craneal (patético o troclear)'],
            ['codigo' => 'H49.2', 'descripcion' => 'Parálisis del sexto par craneal (abductor)'],
            ['codigo' => 'H49.3', 'descripcion' => 'Oftalmoplejia total (externa)'],
            ['codigo' => 'H49.4', 'descripcion' => 'Oftalmoplejia progresiva externa'],
            ['codigo' => 'H49.8', 'descripcion' => 'Otros estrabismos paralíticos'],
            ['codigo' => 'H49.9', 'descripcion' => 'Estrabismo paralítico sin especificar'],

            ['codigo' => 'H50', 'descripcion' => 'Otros estrabismos'],
            ['codigo' => 'H50.0', 'descripcion' => 'Estrabismo concomitante convergente'],
            ['codigo' => 'H50.1', 'descripcion' => 'Estrabismo concomitante divergente'],
            ['codigo' => 'H50.2', 'descripcion' => 'Estrabismo vertical'],
            ['codigo' => 'H50.3', 'descripcion' => 'Heterotropía intermitente'],
            ['codigo' => 'H50.4', 'descripcion' => 'Otras heterotropías y heterotropías sin especificar'],
            ['codigo' => 'H50.5', 'descripcion' => 'Heteroforia'],
            ['codigo' => 'H50.6', 'descripcion' => 'Estrabismo mecánico'],
            ['codigo' => 'H50.8', 'descripcion' => 'Otros estrabismos especificados'],
            ['codigo' => 'H50.9', 'descripcion' => 'Estrabismos sin especificar'],

            ['codigo' => 'H51.0', 'descripcion' => 'Parálisis de la mirada conjugada'],
            ['codigo' => 'H51.1', 'descripcion' => 'Exceso e insuficiencia de convergencia'],
            ['codigo' => 'H51.2', 'descripcion' => 'Oftalmoplejía internuclear'],
            ['codigo' => 'H51.8', 'descripcion' => 'Otros trastornos del movimiento binocular especificados'],
            ['codigo' => 'H51.9', 'descripcion' => 'Trastorno del movimiento binocular sin especificar'],

            ['codigo' => 'H52.0', 'descripcion' => 'Hipermetropía'],
            ['codigo' => 'H52.1', 'descripcion' => 'Miopía'],
            ['codigo' => 'H52.2', 'descripcion' => 'Astigmatismo'],
            ['codigo' => 'H52.3', 'descripcion' => 'Anisometropía y aniseiconía'],
            ['codigo' => 'H52.4', 'descripcion' => 'Presbicia'],
            ['codigo' => 'H52.5', 'descripcion' => 'Trastornos de acomodación'],
            ['codigo' => 'H52.6', 'descripcion' => 'Otros trastornos de refracción'],
            ['codigo' => 'H52.7', 'descripcion' => 'Trastorno de refracción sin especificar'],

            ['codigo' => 'H53.0', 'descripcion' => 'Ambliopía y anopsia'],
            ['codigo' => 'H53.1', 'descripcion' => 'Alteraciones visuales subjetivas'],
            ['codigo' => 'H53.2', 'descripcion' => 'Diplopía'],
            ['codigo' => 'H53.3', 'descripcion' => 'Otros trastornos de la visión binocular'],
            ['codigo' => 'H53.4', 'descripcion' => 'Defectos del campo visual'],
            ['codigo' => 'H53.5', 'descripcion' => 'Daltonismo'],
            ['codigo' => 'H53.6', 'descripcion' => 'Nictalopia'],

            ['codigo' => 'H54', 'descripcion' => 'Ceguera y baja visión'],

            ['codigo' => 'H55', 'descripcion' => 'Nistagmo y otros movimientos irregulares del ojo'],

            ['codigo' => 'H57.0', 'descripcion' => 'Anomalías de la función pupila'],
            ['codigo' => 'H57.1', 'descripcion' => 'Dolor ocular'],
            ['codigo' => 'H57.9', 'descripcion' => 'Trastorno del ojo y anexos sin especificar'],

            ['codigo' => 'H58', 'descripcion' => 'Otros trastornos del ojo y anexos en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H58.0', 'descripcion' => 'Anomalías de la función pupilar en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H59', 'descripcion' => 'Trastornos postprocedurales del ojo y anexos no clasificados en otra parte']
        ]);
    }
}
