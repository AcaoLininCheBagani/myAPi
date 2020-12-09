<?php

namespace App\Http\Controllers;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedPointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register']]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => 'true',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expirese_in' => $this->guard()->factory()->getTTL()*60,
        ]);
    }
    public function guard(){
        return \Auth::guard('api');
    }

    //login
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        if($token = auth('api')->attempt($credentials))
        {
            return $this->respondWithToken($token);
        }

        return response()->json(['status' => false,'error' => 'Invalid username or password.'],301);
    }

    //register
    public function register(Request $request)
    {
        $record = new User;
        $record->name = $request->name;
        $record->email = $request->email;
        $record->password = Hash::make($request->password);
        $record->save();
        return response()->json(['status'=> true, 'message' => 'User created']);
    }
}
