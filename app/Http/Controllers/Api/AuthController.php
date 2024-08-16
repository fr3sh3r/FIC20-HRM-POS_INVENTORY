<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Login
    public function login(Request $request)
    {
        //validate request enmail and password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);  //jika email dan passwordnya ga ada, maka akan dikembalikan dengan error 422
        //A 422 status code indicates that the server was unable to process the request because it contains invalid data.

        //if credentials are correct
        $user = User::where('email', $request->email)->first();

        //if $user = NULL then errocode 404
        //jika tidak NULL naka dicek passwordnya
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createTokern('hrm-token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }


    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Logged Out'
        ], 200);
    }
}
