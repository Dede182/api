<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => "required|min:3",
            'email'=> "required|email|unique:users",
            'password' => "required|min:6|confirmed"
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        // if(Auth::attempt($request->only(['email','password']))){
        //     $tokens = Auth::user()->createToken('phone')->plainTextToken;
        //     return response()->json(["token" => $tokens],200);
        // }

             return response()->json(['message' => "Register successful",'success' =>true],200);

    }


    public function login(Request $request){
        $request->validate([
            'email'=> "required|email",
            'password' => "required|min:6"
        ]);

        if(Auth::attempt($request->only(['email','password']))){
            $tokens = Auth::user()->createToken('phone')->plainTextToken;
            return response()->json([
                'message' => "login successful",
                'token' => $tokens,
                'auth' => new UserResource(Auth::user()),
                "success"  => true,
            ]);
        }
        return response()->json(['message' => "user not found",'success' => false],403);
    }


    public function logout(){
         Auth::user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout successfully'], 204);
    }

    public function logoutAll(){
        return Auth::user()->tokens()->delete();

    }
    public function tokens(){

    }
}
