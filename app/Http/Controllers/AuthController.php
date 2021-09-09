<?php

namespace App\Http\Controllers;

use App\Models\Info\UserAttr;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            UserAttr::FULLNAME => 'required|string|max:255',
            UserAttr::EMAIL => 'required|string|email|max:255|unique:users',
            UserAttr::PASSWORD => 'required|string|min:8'
        ]);

        $user = User::create([
            UserAttr::FULLNAME => $validatedData[UserAttr::FULLNAME],
            UserAttr::EMAIL => $validatedData[UserAttr::EMAIL],
            UserAttr::PASSWORD => Hash::make($validatedData[UserAttr::PASSWORD]),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
           'access_token' => $token,
           'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = Auth::user();
        if ($user->role->isAdmin == false){
            Auth::logout();
            return response()->json([
                'msg' => 'Incorrect login details, you are User'
            ], 401);
        };
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Success'
        ]);
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
}
