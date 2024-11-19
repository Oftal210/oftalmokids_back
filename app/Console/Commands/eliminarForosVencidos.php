<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Foro;

class eliminarForosVencidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eliminar-foros-vencidos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando se encarga de eliminiar los foros que tenga una fecha de vencimiento igual al dia actual o a la fecha que se realice la funcion';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        // tomamos el dia actual dia actual
        $diaActual = Carbon::now()->startOfDay();

        // buscamos los foros que caduquen con la variable anterior
        $forosEliminados = Foro::whereDate('fecha_vencimiento', $diaActual)->delete();

        // retornamos un pequeño mensaje con los foros que fueron eliminados
        $this->info("Se han eliminado {$forosEliminados} foros con fecha de vencimiento {$diaActual->toDateString()}.");
        
        return 0;
    }
}
