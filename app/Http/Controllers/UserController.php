<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function create(UserCreateRequest $request): array
    {
        $attr = $request->validated();

        $user = User::create(
            [
                'name' => $attr['name'],
                'password' => bcrypt($attr['password']),
                'email' => $attr['email']
            ]
        );

        return [
            'data' => UserResource::make($user),
            'access_token' => $user->createToken('tokens')->plainTextToken,
        ];
    }
}
