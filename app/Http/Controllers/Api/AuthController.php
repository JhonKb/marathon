<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Logs in a user
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Credentials not matched',
            ], 400);
        }
    }

    /**
     * Logs the user out
     * @param User $user
     * @return JsonResponse
     */
    public function logout(User $user): JsonResponse
    {
        try {
            $user->tokens()->delete();

            return response()->json([
                'status' => false,
                'message' => 'Logged out successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Logged out error: ' . $e->getMessage()
            ], 400);
        }
    }
}
