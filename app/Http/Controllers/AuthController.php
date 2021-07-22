<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

//        $token = $user->createToken('change this')->plainTextToken;
        $token = $user->createToken('API Token')->plainTextToken;
        return (new UserResource($user))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);

//        return response([
//            'success' => $user->createToken('API Token')->plainTextToken
//        ]);
    }
}
