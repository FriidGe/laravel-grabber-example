<?php

namespace App\Console;

use App\Jobs\NewsJob;
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
        //
    ];

    /**
     * @var Schedule Scheduler which allow to plane time of operations
     */
    private $scheduler;

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $this->scheduler = $schedule;
        $this->scheduleNewsJob();
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

    /**
     * Schedule grab and save news.
     *
     * @return void
     */
    private function scheduleNewsJob(): void
    {
        $this->scheduler
            ->job(NewsJob::class)
            ->everyMinute();
    }
}
