<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function update(UserRequest $request, User $user) : JsonResponse {
        $data  = $request->validated();


       $user =  $this->userService->update($user, $data);
        return response()->json([
            'message' => true,
            'user' => new UserResource($user)
        ]);
    }

    public function show(int $id) : JsonResponse {
        $user = User::findOrFail($id);

        return response()->json([
            'user' => new UserResource($user),
            'status' => true
        ]);
    }

}
