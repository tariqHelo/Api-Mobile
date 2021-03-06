<?php

namespace App\Http\Controllers\Api;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
     public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login' , 'register']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'email' =>'required|email',
            'password' =>'required',
            'c_password' =>'required|same:password',
        ]); 

        if ($validator->fails()) {
            return $this->sendError('Please validate error' ,$validator->errors() );
        }

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            //$token = $request->user()->createToken($request->token_name);
            $success['accessToken'] = $user->createToken('password')->accessToken;
            $success['name'] = $user->name;

        return $this->sendResponse($success ,'User registered successfully' );
    }


    public function login(Request $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
        
            $user = Auth::User();
            $success['token'] = $user->createToken('password')->accessToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success ,'User login successfully' );
        }
        else{
            return $this->sendError('Please check your Auth' ,['error'=> 'Unauthorized'] );
        }

    }
    
    public function me()
    {
     return response()->json(auth()->user());
    }

    // public function logout() {
    //   //  dd(20);
    //     auth()->logout();
    //     return $this->sendResponse('User successfully logged out');
    // }

    public function logout()
        { 
            if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
             return response()->json([
             'message' => 'Successfully logged out'
             ]);
            }
       // return $this->sendResponse('User successfully logged out');

        }
}
