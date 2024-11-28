<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos de Artisan de tu aplicación.
     *
     * @var array
     */
    protected $commands = [
        // Registra tus comandos de Artisan personalizados aquí
    ];

    /**
     * Define la programación de tareas.
     */
    protected function schedule(Schedule $schedule)
    {
        // especificamos el comando para ejecutar las funciones que se van a realizar
    }

    /**
     * Registra los comandos para la aplicación.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
