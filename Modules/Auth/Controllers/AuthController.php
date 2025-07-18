<?php

namespace Modules\Auth\Controllers;

use Illuminate\Http\Request;
use Modules\Auth\Requests\RegisterRequest;
use Modules\Auth\Requests\LoginRequest;
use Modules\Auth\Services\AuthService;

class AuthController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());
        $token = $user->createToken('api')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authService->login($request->validated());
        if (!$user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token = $user->createToken('api')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
