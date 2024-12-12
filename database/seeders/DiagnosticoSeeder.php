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
            ['codigo' => 'H000', 'descripcion' => 'Orzuelo y otras inflamaciones profundas del párpado'],
            ['codigo' => 'H001', 'descripcion' => 'Chalazion'],

            ['codigo' => 'H01', 'descripcion' => 'Otras inflamaciones del párpado'],
            ['codigo' => 'H010', 'descripcion' => 'Blefaritis'],
            ['codigo' => 'H011', 'descripcion' => 'Dermatosis no infecciosa del párpado'],
            ['codigo' => 'H018', 'descripcion' => 'Otras inflamaciones especificadas del párpado'],
            ['codigo' => 'H019', 'descripcion' => 'Inflamación del párpado, no especificada'],

            ['codigo' => 'H02', 'descripcion' => 'Otros trastornos de los párpados'],
            ['codigo' => 'H020', 'descripcion' => 'Entropión y triquiasis palpebral'],
            ['codigo' => 'H021', 'descripcion' => 'Ectropión del párpado'],
            ['codigo' => 'H022', 'descripcion' => 'Lagoftalmos'],
            ['codigo' => 'H023', 'descripcion' => 'Blefarocalasia'],
            ['codigo' => 'H024', 'descripcion' => 'Blefaroptosis'],
            ['codigo' => 'H025', 'descripcion' => 'Otros trastornos funcionales del párpado'],
            ['codigo' => 'H026', 'descripcion' => 'Xantelasma del párpado'],
            ['codigo' => 'H027', 'descripcion' => 'Otros trastornos degenerativos del párpado y del área periocular'],
            ['codigo' => 'H028', 'descripcion' => 'Otros trastornos especificados del párpado'],
            ['codigo' => 'H029', 'descripcion' => 'Trastorno del párpado, no especificado'],
        
            ['codigo' => 'H03', 'descripcion' => 'Trastornos del párpado en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H030', 'descripcion' => 'Infección e infestación parasitarias del párpado en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H031', 'descripcion' => 'Compromiso del párpado en enfermedades infecciosas clasificadas en otra parte'],
            ['codigo' => 'H032', 'descripcion' => 'Compromiso del párpado en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H04', 'descripcion' => 'Trastornos del aparato lagrimal'],
            ['codigo' => 'H040', 'descripcion' => 'Dacrioadenitis'],
            ['codigo' => 'H041', 'descripcion' => 'Otros trastornos de la glándula lagrimal'],
            ['codigo' => 'H042', 'descripcion' => 'Epífora'],
            ['codigo' => 'H043', 'descripcion' => 'Inflamación aguda y las no especificadas en otra parte'],
            ['codigo' => 'H044', 'descripcion' => 'Inflamación crónica de las vías lagrimales'],
            ['codigo' => 'H045', 'descripcion' => 'Estenosis e insuficiencia de las vías lagrimales'],
            ['codigo' => 'H046', 'descripcion' => 'Otros cambios de las vías lagrimales'],
            ['codigo' => 'H048', 'descripcion' => 'Otros trastornos especificados del aparato lagrimal'],
            ['codigo' => 'H049', 'descripcion' => 'Trastorno del aparato lagrimal, no especificado'],

            ['codigo' => 'H05', 'descripcion' => 'Trastornos de la órbita'],
            ['codigo' => 'H050', 'descripcion' => 'Inflamación aguda de la órbita'],
            ['codigo' => 'H051', 'descripcion' => 'Trastornos inflamatorios crónicos de la órbita'],
            ['codigo' => 'H052', 'descripcion' => 'Afecciones exoftálmicas'],
            ['codigo' => 'H053', 'descripcion' => 'Deformidad de la órbita'],
            ['codigo' => 'H054', 'descripcion' => 'Enoftalmía'],
            ['codigo' => 'H055', 'descripcion' => 'Retención de cuerpo extraño, consecutiva a herida penetrante de la órbita'],
            ['codigo' => 'H058', 'descripcion' => 'Otros trastornos de la órbita'],
            ['codigo' => 'H059', 'descripcion' => 'Trastorno de la órbita, no especificado'],

            ['codigo' => 'H06', 'descripcion' => 'Trastornos del aparato lagrimal y de la órbita en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H060', 'descripcion' => 'Trastornos del aparato lagrimal en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H061', 'descripcion' => 'Infección e infestación parasitarias de la órbita en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H062', 'descripcion' => 'Exoftalmia hipertiroidea'],
            ['codigo' => 'H063', 'descripcion' => 'Otros trastornos de la órbita en enfermedades clasificadas en otra parte'],
        
            ['codigo' => 'H10', 'descripcion' => 'Conjuntivitis'],
            ['codigo' => 'H100', 'descripcion' => 'Conjuntivitis mucopurulenta'],
            ['codigo' => 'H101', 'descripcion' => 'Conjuntivitis atópica aguda'],
            ['codigo' => 'H102', 'descripcion' => 'Otras conjuntivitis agudas'],
            ['codigo' => 'H103', 'descripcion' => 'Conjuntivitis aguda, no especificada'],
            ['codigo' => 'H104', 'descripcion' => 'Conjuntivitis crónica'],
            ['codigo' => 'H105', 'descripcion' => 'Blefaroconjuntivitis'],
            ['codigo' => 'H108', 'descripcion' => 'Otras conjuntivitis'],
            ['codigo' => 'H109', 'descripcion' => 'Conjuntivitis, no especificada'],

            ['codigo' => 'H11', 'descripcion' => 'Otros trastornos de la conjuntiva'],
            ['codigo' => 'H110', 'descripcion' => 'Pterigión'],
            ['codigo' => 'H111', 'descripcion' => 'Degeneraciones y depósitos conjuntivales'],
            ['codigo' => 'H112', 'descripcion' => 'Cicatrices conjuntivales'],
            ['codigo' => 'H113', 'descripcion' => 'Hemorragia conjuntival'],
            ['codigo' => 'H114', 'descripcion' => 'Otros trastornos vasculares y quistes conjuntivales'],
            ['codigo' => 'H118', 'descripcion' => 'Otros trastornos especificados de la conjuntiva'],
            ['codigo' => 'H119', 'descripcion' => 'Trastorno de la conjuntiva, no especificado'],

            ['codigo' => 'H13', 'descripcion' => 'Trastornos de la conjuntiva en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H130', 'descripcion' => 'Infección filárica de la conjuntiva'],
            ['codigo' => 'H131', 'descripcion' => 'Conjuntivitis en enfermedades infecciosas parasitarias clasificadas en otra parte'],
            ['codigo' => 'H132', 'descripcion' => 'Conjuntivitis en otras enfermedades clasificadas en otra parte'],
            ['codigo' => 'H133', 'descripcion' => 'Penfigoide ocular'],
            ['codigo' => 'H138', 'descripcion' => 'Otros trastornos de la conjuntiva en enfermedades clasificadas en otra parte'],
        
            ['codigo' => 'H15', 'descripcion' => 'Trastornos de la esclerótica'],
            ['codigo' => 'H150', 'descripcion' => 'Escleritis'],
            ['codigo' => 'H151', 'descripcion' => 'Episcleritis'],
            ['codigo' => 'H158', 'descripcion' => 'Otros trastornos de la esclerótica'],
            ['codigo' => 'H159', 'descripcion' => 'Trastorno de la esclerótica, no especificado'],

            ['codigo' => 'H16', 'descripcion' => 'Queratitis'],
            ['codigo' => 'H160', 'descripcion' => 'Úlcera de córnea'],
            ['codigo' => 'H161', 'descripcion' => 'Otras queratitis superficiales sin conjuntivitis'],
            ['codigo' => 'H162', 'descripcion' => 'Queratoconjuntivitis'],
            ['codigo' => 'H163', 'descripcion' => 'Queratitis intersticial y profunda'],
            ['codigo' => 'H164', 'descripcion' => 'Neovascularización corneal'],

            ['codigo' => 'H17', 'descripcion' => 'Cicatrices y opacidades córneales'],

            ['codigo' => 'H18', 'descripcion' => 'Otros trastornos de la córnea'],
            ['codigo' => 'H180', 'descripcion' => 'Pigmentaciones y depósitos corneales'],
            ['codigo' => 'H181', 'descripcion' => 'Queratopatía bullosa'],
            ['codigo' => 'H182', 'descripcion' => 'Otros edemas corneales'],
            ['codigo' => 'H183', 'descripcion' => 'Cambios en membranas corneales'],
            ['codigo' => 'H184', 'descripcion' => 'Degeneración corneal'],
            ['codigo' => 'H185', 'descripcion' => 'Distrofias corneales hereditarias'],
            ['codigo' => 'H186', 'descripcion' => 'Queratocono'],
            ['codigo' => 'H187', 'descripcion' => 'Otras deformidades corneales'],
            ['codigo' => 'H188', 'descripcion' => 'Otros trastornos especificados de córnea'],
            ['codigo' => 'H189', 'descripcion' => 'Trastorno de córnea sin especificar'],

            ['codigo' => 'H19', 'descripcion' => 'Trastornos de la esclerótica y la córnea en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H190', 'descripcion' => 'Escleritis y Episcleritis en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H191', 'descripcion' => 'Queratitis y Queratoconjuntivitis herpesviral'],
            ['codigo' => 'H192', 'descripcion' => 'Queratitis y Queratoconjuntivitis en otras enfermedades infecciosas y parásitas'],
            ['codigo' => 'H193', 'descripcion' => 'Queratitis y Queratoconjuntivitis en otras enfermedades clasificadas en otra parte'],
            ['codigo' => 'H198', 'descripcion' => 'Otros trastornos de la esclerótica y la córnea en enfermedades clasificadas en otra parte'],
            ['codigo' => 'T150', 'descripcion' => 'Cuerpo extraño en córnea'],
        
        
            ['codigo' => 'H20', 'descripcion' => 'Iridociclitis'],
            ['codigo' => 'H200', 'descripcion' => 'Iridociclitis aguda y subaguda'],

            ['codigo' => 'H21', 'descripcion' => 'Otros trastornos del iris y del cuerpo ciliar'],
            ['codigo' => 'H210', 'descripcion' => 'Hifema'],
            ['codigo' => 'H211', 'descripcion' => 'Otros trastornos vasculares del iris y del cuerpo ciliar'],
            ['codigo' => 'H212', 'descripcion' => 'Degeneración del iris y el cuerpo ciliar'],
            ['codigo' => 'H213', 'descripcion' => 'Quiste del iris, del cuerpo ciliar y de la cámara anterior'],
            ['codigo' => 'H214', 'descripcion' => 'Membranas pupilares'],
            ['codigo' => 'H215', 'descripcion' => 'Otras adhesiones y disrupciones del iris y del cuerpo ciliar'],
            ['codigo' => 'H218', 'descripcion' => 'Otros trastornos especificados del iris y del cuerpo ciliar'],
            ['codigo' => 'H219', 'descripcion' => 'Uveítis'],

            ['codigo' => 'H22', 'descripcion' => 'Trastornos del iris y del cuerpo ciliar en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H25', 'descripcion' => 'Catarata senil'],

            ['codigo' => 'H26', 'descripcion' => 'Otras cataratas'],

            ['codigo' => 'H27', 'descripcion' => 'Otros trastornos del cristalino'],
            ['codigo' => 'H270', 'descripcion' => 'Afaquia'],
            ['codigo' => 'H271', 'descripcion' => 'Dislocación del cristalino'],

            ['codigo' => 'H28', 'descripcion' => 'Cataratas y otros trastornos del cristalino en enfermedades clasificadas en otra parte'],
            ['codigo' => 'Z961', 'descripcion' => 'Pseudofaquia'],

            ['codigo' => 'H30', 'descripcion' => 'Inflamación coriorretiniana'],

            ['codigo' => 'H31', 'descripcion' => 'Otros trastornos coroideos'],

            ['codigo' => 'H32', 'descripcion' => 'Trastornos coriorretinales en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H33', 'descripcion' => 'Desprendimiento de retina con ruptura'],
            ['codigo' => 'H331', 'descripcion' => 'Retinosquisis y quistes retinales'],

            ['codigo' => 'H34', 'descripcion' => 'Oclusiones vasculares retinales'],

            ['codigo' => 'H35', 'descripcion' => 'Otros trastornos retinianos'],
            ['codigo' => 'H350', 'descripcion' => 'Retinopatía de fondo y cambios vasculares retinales'],
            ['codigo' => 'H351', 'descripcion' => 'Retinopatía de la prematuridad'],
            ['codigo' => 'H353', 'descripcion' => 'Degeneración de la mácula y el polo posterior'],
            ['codigo' => 'H355', 'descripcion' => 'Distrofia hereditaria retiniana'],
            ['codigo' => 'H356', 'descripcion' => 'Hemorragia retiniana'],
            ['codigo' => 'H358', 'descripcion' => 'Otros trastornos de la retina especificados'],

            ['codigo' => 'H36', 'descripcion' => 'Trastornos retinianos en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H40', 'descripcion' => 'Glaucoma'],
            ['codigo' => 'H400', 'descripcion' => 'Glaucoma sospechoso'],
            ['codigo' => 'H401', 'descripcion' => 'Glaucoma primario de ángulo abierto'],
            ['codigo' => 'H402', 'descripcion' => 'Glaucoma primario de ángulo cerrado'],
            ['codigo' => 'H403', 'descripcion' => 'Glaucoma secundario por trauma ocular'],
            ['codigo' => 'H404', 'descripcion' => 'Glaucoma secundario por inflamación ocular'],
            ['codigo' => 'H405', 'descripcion' => 'Glaucoma secundario por otros trastornos ocular'],
            ['codigo' => 'H406', 'descripcion' => 'Glaucoma secundario por medicamentos'],

            ['codigo' => 'H42', 'descripcion' => 'Glaucoma en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H43', 'descripcion' => 'Trastornos del humor vítreo'],
            ['codigo' => 'H430', 'descripcion' => 'Prolapso vítreo'],
            ['codigo' => 'H431', 'descripcion' => 'Hemorragia vítrea'],
            ['codigo' => 'H432', 'descripcion' => 'Depósitos cristalinos en el humor vítreo'],
            ['codigo' => 'H433', 'descripcion' => 'Otras opacidades vítreas'],
            ['codigo' => 'H438', 'descripcion' => 'Otros trastornos del humor vítreo'],
            ['codigo' => 'H439', 'descripcion' => 'Trastorno del humor vítreo sin especificar'],

            ['codigo' => 'H44', 'descripcion' => 'Trastornos del globo ocular'],
            ['codigo' => 'H440', 'descripcion' => 'Endoftalmitis purulenta'],
            ['codigo' => 'H441', 'descripcion' => 'Otras endoftalmitis'],
            ['codigo' => 'H442', 'descripcion' => 'Miopía degenerativa'],
            ['codigo' => 'H443', 'descripcion' => 'Otros trastornos degenerativos del globo ocular'],
            ['codigo' => 'H444', 'descripcion' => 'Hipotonía ocular'],
            ['codigo' => 'H445', 'descripcion' => 'Enfermedades degenerativas del globo ocular'],
            ['codigo' => 'H446', 'descripcion' => 'Cuerpo extraño intraocular retenido (viejo) magnético'],
            ['codigo' => 'H447', 'descripcion' => 'Cuerpo extraño intraocular retenido (viejo) no-magnético'],
            ['codigo' => 'H448', 'descripcion' => 'Otros trastornos del globo ocular'],
            ['codigo' => 'H449', 'descripcion' => 'Trastorno del globo ocular sin especificar'],

            ['codigo' => 'H45', 'descripcion' => 'Trastornos del cuerpo vítreo y el globo ocular en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H46', 'descripcion' => 'Neuritis óptica'],

            ['codigo' => 'H47', 'descripcion' => 'Otros trastornos del segundo nervio óptico y los campos visuales'],
            ['codigo' => 'H471', 'descripcion' => 'Papiledema sin especificar'],
            ['codigo' => 'H472', 'descripcion' => 'Atrofia óptica'],

            ['codigo' => 'H48', 'descripcion' => 'Trastornos del segundo nervio óptico y los campos visuales en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H49', 'descripcion' => 'Estrabismo paralítico'],
            ['codigo' => 'H490', 'descripcion' => 'Parálisis del tercer par craneal (motor ocular común)'],
            ['codigo' => 'H491', 'descripcion' => 'Parálisis del cuarto par craneal (patético o troclear)'],
            ['codigo' => 'H492', 'descripcion' => 'Parálisis del sexto par craneal (abductor)'],
            ['codigo' => 'H493', 'descripcion' => 'Oftalmoplejia total (externa)'],
            ['codigo' => 'H494', 'descripcion' => 'Oftalmoplejia progresiva externa'],
            ['codigo' => 'H498', 'descripcion' => 'Otros estrabismos paralíticos'],
            ['codigo' => 'H499', 'descripcion' => 'Estrabismo paralítico sin especificar'],

            ['codigo' => 'H50', 'descripcion' => 'Otros estrabismos'],
            ['codigo' => 'H500', 'descripcion' => 'Estrabismo concomitante convergente'],
            ['codigo' => 'H501', 'descripcion' => 'Estrabismo concomitante divergente'],
            ['codigo' => 'H502', 'descripcion' => 'Estrabismo vertical'],
            ['codigo' => 'H503', 'descripcion' => 'Heterotropía intermitente'],
            ['codigo' => 'H504', 'descripcion' => 'Otras heterotropías y heterotropías sin especificar'],
            ['codigo' => 'H505', 'descripcion' => 'Heteroforia'],
            ['codigo' => 'H506', 'descripcion' => 'Estrabismo mecánico'],
            ['codigo' => 'H508', 'descripcion' => 'Otros estrabismos especificados'],
            ['codigo' => 'H509', 'descripcion' => 'Estrabismos sin especificar'],

            ['codigo' => 'H510', 'descripcion' => 'Parálisis de la mirada conjugada'],
            ['codigo' => 'H511', 'descripcion' => 'Exceso e insuficiencia de convergencia'],
            ['codigo' => 'H512', 'descripcion' => 'Oftalmoplejía internuclear'],
            ['codigo' => 'H518', 'descripcion' => 'Otros trastornos del movimiento binocular especificados'],
            ['codigo' => 'H519', 'descripcion' => 'Trastorno del movimiento binocular sin especificar'],

            ['codigo' => 'H520', 'descripcion' => 'Hipermetropía'],
            ['codigo' => 'H521', 'descripcion' => 'Miopía'],
            ['codigo' => 'H522', 'descripcion' => 'Astigmatismo'],
            ['codigo' => 'H523', 'descripcion' => 'Anisometropía y aniseiconía'],
            ['codigo' => 'H524', 'descripcion' => 'Presbicia'],
            ['codigo' => 'H525', 'descripcion' => 'Trastornos de acomodación'],
            ['codigo' => 'H526', 'descripcion' => 'Otros trastornos de refracción'],
            ['codigo' => 'H527', 'descripcion' => 'Trastorno de refracción sin especificar'],

            ['codigo' => 'H530', 'descripcion' => 'Ambliopía y anopsia'],
            ['codigo' => 'H531', 'descripcion' => 'Alteraciones visuales subjetivas'],
            ['codigo' => 'H532', 'descripcion' => 'Diplopía'],
            ['codigo' => 'H533', 'descripcion' => 'Otros trastornos de la visión binocular'],
            ['codigo' => 'H534', 'descripcion' => 'Defectos del campo visual'],
            ['codigo' => 'H535', 'descripcion' => 'Daltonismo'],
            ['codigo' => 'H536', 'descripcion' => 'Nictalopia'],

            ['codigo' => 'H54', 'descripcion' => 'Ceguera y baja visión'],

            ['codigo' => 'H55', 'descripcion' => 'Nistagmo y otros movimientos irregulares del ojo'],

            ['codigo' => 'H570', 'descripcion' => 'Anomalías de la función pupila'],
            ['codigo' => 'H571', 'descripcion' => 'Dolor ocular'],
            ['codigo' => 'H579', 'descripcion' => 'Trastorno del ojo y anexos sin especificar'],

            ['codigo' => 'H58', 'descripcion' => 'Otros trastornos del ojo y anexos en enfermedades clasificadas en otra parte'],
            ['codigo' => 'H580', 'descripcion' => 'Anomalías de la función pupilar en enfermedades clasificadas en otra parte'],

            ['codigo' => 'H59', 'descripcion' => 'Trastornos postprocedurales del ojo y anexos no clasificados en otra parte']
        ]);
    }
}
