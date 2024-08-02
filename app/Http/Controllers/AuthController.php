<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['message' => 'User registered successfully', 'user' => $user, 'token' => $token], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid email or password'], 401);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['message' => 'User logged in successfully', 'user' => $user, 'token' => $token], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = $request->user(); 

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $user->update($request->only('name', 'email'));

            return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
