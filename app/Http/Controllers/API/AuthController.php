<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private AuthService $service;


    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }


    public function register(AuthenticationRequest $request) : JsonResponse
    {
        $data = $request->validated();

        $user = $this->service->authenticate($data);

        $token = $user->createToken('ApiToken')->accessToken;

        return response()->json([
            'message' => true,
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }



    public function login(LoginRequest $request) : JsonResponse {
        $data = $request->validated();

        $user = $this->service->login($data);
        $token = $user->createToken('ApiToken')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}
