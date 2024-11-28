<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('eliminar-foros-vencidos')->dailyAt('23:00');

Schedule::command('verificar-preconsultas-hijos')->weeklyOn(0, '23:00');


