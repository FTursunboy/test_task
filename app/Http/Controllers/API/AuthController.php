<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private AuthService $service;


    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }


    public function authenticate(Request $request): \Illuminate\Http\JsonResponse
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'first_name' => 'required|min:3|max:15',
            'last_name' => 'required|min:3|max:15',
            'patronymic' => 'nullable|string|min:3|max:15',
            'gender' => 'required|boolean',
            'avatar_img' => 'nullable|file',
            'login' => 'required|min:3|max:15|unique:users,login',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'birth_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $this->service->authenticate($data);

        $token = $user->createToken('ApiToken');

        return response()->json([
            'message' => true,
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }



    public function login(LoginRequest $request) {
        $data = $request->validated();

        $user = $this->service->login($data);
        $token = $user->createToken('ApiToken');

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}
