<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use JWTAuthException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;

        // credenziali non valide
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_credentials',
                ]);
            }
        } catch (JWTAuthException $e) {
            // errore generico
            return response()->json([
                'response' => 'error',
                'message' => 'cannot_create_token',
            ]);
        }

        // auth effettuata
        // restituire il token
        return response()->json([
            'response' => 'success',
            'token' => $token,
        ]);
    }
}
