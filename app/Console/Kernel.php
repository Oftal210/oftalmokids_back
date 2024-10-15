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
        // Aquí puedes definir las tareas programadas
        // Ejemplo: Ejecutar un comando cada domingo a las 11:00 p.m.
        $schedule->command('verificar-preconsultas-hijos')->weeklyOn(0, '23:00');
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
