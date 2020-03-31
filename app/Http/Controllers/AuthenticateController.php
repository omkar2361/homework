<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    //Register

    //Login
    public function login(Request $request)
    {
        //Validation
        // $this->validateData($request->all(), User::loginValidationRules());

        try {
            // Attempt to verify the credentials
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        //Store token in user tokens table

        //Get user
        $user = Auth::user();
        $user->createToken('token');

    }

    public function logout(Request $request)
    {
        //Make sure the tokens are deleted
        if ($request->delete_tokens === true) {
            $user = Auth::user()->tokens()->delete();
        }

        Auth::logout();
    }
}
