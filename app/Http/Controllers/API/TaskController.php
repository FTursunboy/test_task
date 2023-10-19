<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Models\TaskNotification;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(TaskRequest $request, int $id) : JsonResponse {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => true,
                'info' => 'Такого полӣзовтеля не существует'
            ]);
        }

        $data = $request->validated();

        $task = $this->taskService->store($data, $user);

        return response()->json([
            'message' => true,
            'task' => new TaskResource($task)
        ]);
    }


    public function update(TaskRequest $request, User $user, int $id) : JsonResponse {
        $data = $request->validated();
        $taskNotification = TaskNotification::findOrFail($id);

        $task = $this->taskService->update($data, $user, $taskNotification);

        return response()->json([
            'task' => new TaskResource($task),
            'message' => true,
        ]);
    }

    public function show(TaskNotification $task) : JsonResponse {
        return response()->json([
            'task' => new TaskResource($task),
            'result' => true
        ]);
    }

    public function delete(int $id) :JsonResponse {
        $task = TaskNotification::findOrFail($id);

        $task->delete();

        return response()->json([
            'message' => true
        ]);
    }
}
