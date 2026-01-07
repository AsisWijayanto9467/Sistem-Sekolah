<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register() {

    }

    public function login(Request $request) {
        $credentials = $request->validate([
            "username" => "required|string",
            "password" => "required"
        ]);

        if(!Auth::guard("web")->attempt($credentials)) {
            throw ValidationException::withMessages([
                "username" => ["username atau password anada salah"]
            ]);
        };

        $user = User::where("username", $request->username)->firstOrFail();

        $user->tokens()->delete();

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "success" => "Berhasil melakukan login",
            "token" => $token,
            "user" => $user
        ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "success" => "Berhasil melakukan logout"
        ]);
    }
}
