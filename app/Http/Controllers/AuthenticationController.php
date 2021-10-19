<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request)
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

    // this method signs out users by removing tokens
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function me()
    {
        return UserResource::make(\auth()->user());
    }
}
