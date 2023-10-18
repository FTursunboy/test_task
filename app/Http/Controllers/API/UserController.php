<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function update(UserRequest $request, User $user) {
        $data  = $request->validated();


       $user =  $this->userService->update($user, $data);
        return response()->json([
            'return' => true,
            'user' => new UserResource($user)
        ]);
    }

    public function show(int $id) {
        $user = User::findOrFail($id);

        return response()->json([
            'user' => new UserResource($user),
            'message' => true
        ]);
    }

}
