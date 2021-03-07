<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use App\User;
use Validator;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|between:2,100',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|confirmed|string|min:6',
            //  'address_id' => 'required|numeric',
        ]);

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'Successfully registered',
            'user' => $user
        ], 201);
    }

    
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);

        }

        $email = $request->email;
        $users = User::where('email', $email)->first();
      
        

        return $this->respondWithToken($users, $token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($users, $token)
    {
    	//$id = $users->id;

        return (['user' => $users, 'token' => $token]);
        		
            	//'token' => $token,
           	 	//'token_type' => 'bearer',
           	 	//'expires_in' => JWTFactory::getTTL() * 60
        	
    	
    }

}
