<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        public function create(UserCreateRequest $request)
        {
            $attr = $request->validated();
            
            $user = User::create([
                'name' => $attr['name'],
                'password' => bcrypt($attr['password']),
                'email' => $attr['email']
            ]);

//            Auth::user()->

            return [
                'data' => UserResource::make($user),
                'access_token' => $user->createToken('tokens')->plainTextToken,
            ];
        }
}
