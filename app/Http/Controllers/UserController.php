<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('assign.guard:user', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        try {
            if (! $token = JWTAuth::attempt($validator->validated())) {
                return response()->json([
                	'success' => false,
                	'message' => 'Unauthorized.',
                ], 401);
            }
        } catch (JWTException $e) {
    		return $validator->validated();
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }

        return $this->createNewToken($token);
        
    }
    /**
     * Register a Vendor.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|between:2,20',
            'lastname' => 'required|string|between:2,20',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6|max:50',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
        	'success' => true,
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
