<?php

namespace App\Console;

use App\Jobs\SendTaskToUserJob;
use App\Mail\TaskNotificationMail;
use App\Models\TaskNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {

            $tasks = TaskNotification::where('job_time', now()->format('H:i'))
                ->whereRaw("JSON_CONTAINS(days_of_week, ?)", json_encode(now()->dayOfWeek))
                ->get();

            foreach ($tasks as $task) {
                SendTaskToUserJob::dispatch($task);
            }
        })->cron('* * * * *');

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
