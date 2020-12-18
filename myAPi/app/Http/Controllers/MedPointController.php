<?php

namespace App\Http\Controllers;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedPointController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api',['except'=>['login','register']]);
    //     auth('api')->user();
    // }

    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => 'true',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expirese_in' => \Auth::guard('api')->factory()->getTTL()*60,
        ]);
    }
    // public function guard(){
    //     return \Auth::guard('api');
    // }

    //login
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        if($token = \Auth::guard('api')->attempt($credentials))
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
        return response()->json(['status'=> true, 'message' => 'Successfully created account!.']);
    }
    //get user
    //same sa logout pwede gihapon maka get ug info sa user naa or wala ang api
    public function user() {
        return response()->json(\Auth::guard('api')->user());
    }
    //update
    public function update(Request $request , $id)
    {
        try{
            $record = user::findOrFail($id);
            $record->name = $request->name;
            $record->email = $request->email;
            $record->save();

            return  response()->json(['status' => true, 'message' => 'Successfully updated!.']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'No such user!']);
        }
    }
    //logout
    // wala ko kabalo kung unsa ang kalahian sa walay logout api ug sa naa
    //kay karon ako na bantayan naay api or wala same ra ang output hmm ngano kaha.
    public function logout() {
        \Auth::guard('api')->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'logout'
        ], 200);
    }

}
