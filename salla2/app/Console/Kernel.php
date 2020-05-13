<?php

namespace App\Console;

use App\Console\Commands\EmailCron;
use App\Console\Commands\SMSSend;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SMSSend::class,
        EmailCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sms:cron')
            ->everyFifteenMinutes()->appendOutputTo(storage_path('\logs\sms.log'))->withoutOverlapping();

        $schedule->command('email:cron')
            ->everyFifteenMinutes()->appendOutputTo(storage_path('\logs\email.log'))->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
