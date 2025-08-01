<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\FullBackupToFirebase::class,
        \App\Console\Commands\RestoreFromFirebase::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Jadwal backup bisa ditambahkan di sini jika perlu
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
