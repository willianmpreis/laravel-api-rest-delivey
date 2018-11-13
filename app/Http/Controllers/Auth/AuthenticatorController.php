<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;

class AuthenticatorController extends Controller
{    
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user->save();

        return response()->json([
            'message' => 'Registrado com sucesso',
            'user' => $user
        ], 201);
        

    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) return response()->json([
            'message' => 'Acesso negado'
        ], 401);

        $user = $request->user();    
        $token =  $user->createToken('authorized')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Deslogado com sucesso']
        );
    }
}
