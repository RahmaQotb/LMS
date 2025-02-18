<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|string|unique:users,email",
            "password" => ["required", "min:8", "confirmed", Password::defaults()]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Can't Register.",
                "status" => 422,
                "data" => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $token = $user->createToken("API TOKEN OF " . $user->name)->plainTextToken;

        return response()->json([
            "message" => "Registration Done Successfully.",
            "status" => 201,
            "data" => $user,
            "token" => $token
        ], 201);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            "email" => "required|email|exists:users,email",
            "password" => "required|min:8"
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                "message" => "Can't Login.",
                "status" => 422,
                "data" => $validator->errors(),
            ], 422);
        }
    
        $user = User::where("email", $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "Credentials not correct.",
                "status" => 403,
                "data" => null
            ], 403);
        }
    
        // if ($user->tokens()->count() > 0) {
        //     return response()->json(["message" => "Already logged in."], 409);
        // }
    
        $token = $user->createToken("API TOKEN OF " . $user->name)->plainTextToken;
    
        return response()->json([
            "message" => "Login Done Successfully." ,
            "status" => 200,
            "data" => $user,
            "token" =>$token
        ], 200);
    }
    

    public function logout(Request $request){
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated or Invalid Token'], 401);
        }

        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
