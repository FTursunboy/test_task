<?php

namespace App\Jobs;

use App\Mail\TaskNotificationMail;
use App\Models\TaskNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTaskToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private TaskNotification $taskNotification;

    /**
     * Create a new job instance.
     */
    public function __construct(TaskNotification $taskNotification)
    {
        $this->taskNotification = $taskNotification;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->taskNotification->user->email)->send(new TaskNotificationMail($this->taskNotification->title, $this->taskNotification->text));
    }
}
