<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): UserResource
    {
        $user = (new User())->createUser($request->toArray());;

        return new UserResource($user);
    }

    public function login(LoginRequest $request): JsonResponse|UserResource
    {
        $user = User::where('email', $request->email)->first();
        $requestData = $request->only('email', 'password');

        if(!$user->checkToken($requestData)) {
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
