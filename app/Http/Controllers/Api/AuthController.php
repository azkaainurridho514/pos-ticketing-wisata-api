<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response([
                'status' => 'error',
                'message' => 'User not found'
            ], 401);
        }
        if ( !Hash::check($request->password, $user->password)) {
            return response([
                'status' => 'error',
                'message' => 'Invalid login details'
            ], 401);
        }
        $token = $user->createToken('token')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
