<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request): array
    {
        $attr = $request->validated();

        if (!Auth::attempt($attr)) {
            return abort(401, 'Credentials not match');
        }

        return [
            'data' => UserResource::make(auth()->user()),
            'access_token' => auth()->user()->createToken('API Token')->plainTextToken,
        ];
    }

    public function logout(): array
    {
        auth()->user()
            ->tokens()
            ->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function me(): UserResource
    {
        return UserResource::make(\auth()->user());
    }
}
