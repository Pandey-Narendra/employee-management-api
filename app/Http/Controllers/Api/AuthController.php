<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

// Models
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Register new user
    */

    public function register(Request $request ) {

        $validate->request([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        if($validation->fails()){
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validate->errors(),
                ], 
                422
            );
        }

        try{

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => hash::make($request->password)
            ]);

            return reaponse()->json(
                [
                    'status' => true,
                    'message' => 'User registered successfully, please login.',
                ],
                201
            );

        }catch(\Throwable $e){
            return response()->json([
                'status' => false,
                'message' => 'Registration failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }   

    
    /**
     * Login user and generate token with expiry
     */

    public function login() {
        $validate->request([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try{
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'credentials' => ['Invalid credentials. Please try again.']
                ]);
            }

            $token = $user->create_token('api-token', ['*'], now()->addHours(24))->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful.',
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => now()->addHours(24)->toDateTimeString(),
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ], 200);

        }catch (ValidationException $e) {
            
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 401);

        }catch (\Throwable $e) {
            
            return response()->json([
                'status' => false,
                'message' => 'Login failed. Try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Logout user (delete current token)
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully.',
            ], 200);

        } catch (\Throwable $e) {
            
            return response()->json([
                'status' => false,
                'message' => 'Logout failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
