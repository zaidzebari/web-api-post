<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    }

    public function login(UserLoginRequest $request)
    {
        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return response()->json([
                'errors' => [
                    'email' => ['error detail not correct']
                ]
            ], 422);
        }
        if (! Hash::check($request->password, $user->password, []))
        {
            return response()->json([
                'errors' => [
                    'email' => ['error detail not correct']
                ]
            ], 401);
        }
        $user->tokens()->delete();

        $token = $user->createToken('API Token')->plainTextToken;
        return (new UserResource($user))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
