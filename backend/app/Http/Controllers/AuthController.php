<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterPostRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterPostRequest $request): UserResource
    {
        $user = new User();
        $user->createUser($request->toArray());

        return new UserResource($user);
    }
}
