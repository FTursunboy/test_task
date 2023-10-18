<?php

namespace App\Http\Services;

use App\Models\TaskNotification;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class TaskService {

    public function store(array $data) : TaskNotification {
        return TaskNotification::create([
            'title' => $data['title'],
            'text' => $data['text'],
            'user_id' => $data['user_id'],
            'days_of_week' => $data['days_of_week'],
            'job_time' => $data['days_of_week']
        ]);
    }

    public function update(array $data, User $user) {
        return $user->update([
            'title' => $data['title'],
            'text' => $data['text'],
            'user_id' => $data['user_id'],
            'days_of_week' => $data['days_of_week'],
            'job_time' => $data['days_of_week']
        ]);
    }

  }
