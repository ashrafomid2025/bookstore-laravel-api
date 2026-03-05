<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
         $validated = $request->validate([
             "name"=> "required|string|min:3|max:25",
            "email"=> "required|string|unique:users,email",
            "password"=> "required|string|min:6|confirmed"
         ]);

         $user = User::create(
            [
                "name"=> $validated["name"],
                "email"=> $validated["email"],
                "password"=> Hash::make($validated["password"]),
            ]
         );
            // create a token for user
         $token = $user->createToken('auth_token')->plainTextToken;

         return response()->json([
            "user"=>$user,
            "token"=>$token
         ]);
    }
}
