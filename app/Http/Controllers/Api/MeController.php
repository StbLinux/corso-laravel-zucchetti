<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class MeController extends Controller
{
    public function me(Request $request)
    {
        try {
            $user = JWTAuth::toUser($request->token);
        } catch (JWTException $e) {
            return response()->json([
                'response' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'response' => 'success',
            'user' => $user,
        ]);
    }
}
