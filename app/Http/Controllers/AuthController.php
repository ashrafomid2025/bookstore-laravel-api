<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    
    public function signup(Request $request){
      $validated =  $request->validate(
         [
            "name"=> "required|string|min:3,max:30",
            "email"=>"required|string|unique:users,email",
            "password"=> "required|string|min:6|confirmed",
         ]
       );
      //  token sanctum, 
      $user =  User::create([
         "name"=> $validated["name"],
         "email"=> $validated["email"],
         "password"=> Hash::make( $validated["password"]),
       ]);

      $token =  $user->createToken("auth_token")->plainTextToken;
      return response()->json([
         "success"=> true,
         "user"=> new UserResource($user),
         "token"=> $token
      ]);
    }



    public function login(){}
}
