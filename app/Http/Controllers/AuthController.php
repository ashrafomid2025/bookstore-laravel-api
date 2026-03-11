<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
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

     public function login(Request $request){
        $validated =  $request->validate([
            "email"=> "required|string",
            "password"=> "required|string|min:6",
      ]);
         

       $user =   User::where('email', $validated["email"])->first();
       if(!$user || !Hash::check($validated["password"], $user->password)){
             return response()->json(
                [
                  "success"=> false,
                  "user"=>new UserResource($user),
                  "message"=> "email or password is incorrect"]
             );
       }
      $token =  $user->createToken("auth_token",["read-book",'update-book','delete-book','insert-book',"read-author"])->plainTextToken;
      return response()->json([
         "success"=> true,
         "user"=> new UserResource($user),
         "token"=> $token,
      ]);

     }

     public function logout(Request $request){
     try{ 
     if($request->user() && $request->user()->currentAccessToken()){
           $request->user()->tokens()->delete();
           return response()->json([
            "message"=> "you are logged out"
           ]);
      }
      }catch(Exception $e){
         return response()->json([
            "message"=> $e->getMessage(),
         ]);
      }
      // return response()->json([
      //    "message"=> "user has already been logout out",
      // ]);
      //  $request->user()->currentAccessToken()->delete();
      //  return response()->json(
      //    [
      //       "data"=> "you are logged out"
      //    ]
      //  );
     }

    
}
