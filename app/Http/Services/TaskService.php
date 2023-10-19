<?php

namespace App\Http\Services;

use App\Models\TaskNotification;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class TaskService {

    public function store(array $data, User $user) : TaskNotification {

        return TaskNotification::create([
            'title' => $data['title'],
            'text' => $data['text'],
            'user_id' => $user->id,
            'days_of_week' => $data['days_of_week'],
            'job_time' => $data['time']
        ]);
    }

    public function update(array $data, User $user, TaskNotification $task) : TaskNotification {

        $task->update([
            'title' => $data['title'],
            'text' => $data['text'],
            'user_id' => $user->id,
            'days_of_week' => $data['days_of_week'],
            'job_time' => $data['time']
        ]);


        return $task;
    }

  }
