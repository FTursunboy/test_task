<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Models\TaskNotification;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(TaskRequest $request) {
        $data = $request->validated();

        $task = $this->taskService->store($data);

        return response()->json([
            'message' => true,
            'task' => new TaskResource($task)
        ]);
    }


    public function update(TaskRequest $request, int $id) {
        $data = $request->validated();
        $task = TaskNotification::findOrFail($id);

        $task = $this->taskService->update($data, $task);

        return response()->json([
            'task' => new TaskResource($task),
            'message' => true,
        ]);
    }

    public function delete(int $id) {
        $task = TaskNotification::findOrFail($id);

        $task->delete();

        return redirect()->json([
            'message' => true
        ]);
    }
}
