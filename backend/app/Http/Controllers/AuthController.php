<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    public function register(RegisterRequest $request): UserResource|JsonResponse
    {
        try {
            $user = (new User())->createUser($request->toArray());;
        } catch (\Throwable $e) {
            return $this->sendError($e->getMessage());
        }

        return new UserResource($user);
    }

    public function login(LoginRequest $request): JsonResponse|UserResource
    {
        $requestData = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if (is_null($user) || !$user->checkToken($requestData)) {
            return response()->json([
                'message' => 'Unauthorized',
                'reason' => 'Invalid email or password'
            ], 401);
        }

        return new UserResource($user);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'User logged out',
        ]);
    }
}
