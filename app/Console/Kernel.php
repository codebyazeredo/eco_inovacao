<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define os comandos Artisan no aplicativo.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Configure a programação de tarefas.
     */
    protected function schedule(Schedule $schedule)
    {
        // Defina tarefas agendadas, como $schedule->command(...);
    }
}
