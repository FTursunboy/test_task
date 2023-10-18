<?php

namespace App\Console\Commands;

use App\Models\TaskNotification;
use Illuminate\Console\Command;

class SendTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-task-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDayOfWeek = now()->dayOfWeek;
        $currentTime = now()->format('H:i');

        $tasks = TaskNotification::whereJsonContains('days_of_week', $currentDayOfWeek)
            ->get();

        
    }
}
