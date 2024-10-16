<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Models\Preconsulta;

class verificarPreconsultasHijos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar-preconsultas-hijos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se verifican si a la semana se registraron preconsultas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mensajes = collect([]);

        // Primero obtenemos las fechas inciales y finales de la semana actual 
        $diainiciosemana = Carbon::now()->startOfWeek();
        $diafinsemana = Carbon::now()->endOfWeek();

        // buscamos a todos los hijos que estan en preconsulta para realizar la verificacion
        $idspreconsulta = Preconsulta::select('id_hijo')->groupBy('id_hijo')->get('id_hijo');

        // les realizamos con el siguiente FOR el siguente proceso
        foreach ($idspreconsulta as $idspreconsul){

            // verificamos si esta semana se inserto un registro con el id indicado
            $verificarpreconsulta = Preconsulta::where('id_hijo', $idspreconsul->id_hijo)
                                               ->whereBetween('fecha_preconsulta', [$diainiciosemana, $diafinsemana])
                                               ->first();

            // Si la variable de arriba viene vacia o no encontro un registro de esta semana hara la parte falsa del sigueinte if
            if($verificarpreconsulta){
                
                // se colocada un mensaje indicando que si se hizo registro
                $mensajes->push('el hijo con ' .  $idspreconsul->id_hijo . ' realizo la consulta');
            } else{

                // se inserta un registro con todo en falso si no hizo la preconsulta a tiempo
                Preconsulta::create([
                    'id_hijo'               => $idspreconsul->id_hijo,
                    'uso_gafa_lentes'       => false,
                    'motivo_uso_gafas'      => 'N/A',
                    'uso_medicamento'       => false,
                    'motivo_uso_medicam'    => 'N/A',
                    'limit_pantalla'        => false,
                    'motiv_limit_pantalla'  => 'N/A',
                    'activid_air_libre'     => false,
                    'motiv_acti_libre'      => 'N/A',
                    'buena_aliment'         => false,
                    'motiv_bue_alimen'      => 'N/A',
                    'solicitar_control'     => false,
                    'motiv_soli_control'    => 'N/A',
                    'puntua_preconsulta'    => 0
                ]);

                // se colocada un mensaje indicando que si se hizo registro
                $mensajes->push('el hijo con ' . $idspreconsul->id_hijo . ' NO realizo la consulta');
            }
        }
        $this->info($mensajes);
        return 0;
    }
}
