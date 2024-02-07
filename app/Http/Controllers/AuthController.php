<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){

        $user=$request->validate([
            "name"=>"required|string",
            "email"=>"required|email",
            "password"=>"required",
            "c_password"=>"required|same:password",
        ]);

        $user = New User([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        if($user->save()){

            $tokenResult = $user->createToken('Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'message'=>"Successfully created user!",
                'accessToken'=>$token,
            ],201);

        }else{

            return response()->json([
                'error'=>"User not created",
            ]);
        }
    }

    public function Login(Request $request){

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $input = request(['email','password']);

        if(!Auth::attempt($input)){
            return response()->json([
                'message'=>'Unauthorized'
            ],401);
        }

        $user = $request->User();
        $token=$user->createToken('Access Token')->plainTextToken;

        return response()->json([
            'accessToken'=>$token,
            'token_type'=>'Bearer',
        ]);
    }

    public function user(Request $request){
        return response()->json($request->user());
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return response()->json([
            'message'=> 'Successfully Logged out'
        ]);
    }
}
