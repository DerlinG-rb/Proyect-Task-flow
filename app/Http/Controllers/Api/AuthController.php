<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // TODO(sesion-05): borra la línea de abajo y descomenta el bloque completo.
        //return response()->json(null, 501);
         $data = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|string|min:8',
         ]);
        
         $user = User::create([
             'name' => $data['name'],
             'email' => $data['email'],
             'password' => Hash::make($data['password']),
         ]);
        
         return response()->json(['user' => $user, 'token' => $user->createToken('taskflow')->plainTextToken]);
    }

    public function login(Request $request)
    {
        // TODO(sesion-05): borra la línea de abajo y descomenta el bloque completo.
        //return response()->json(null, 501);
         $data = $request->validate(['email' => 'required|email', 'password' => 'required|string']);
         $user = User::where('email', $data['email'])->first();
        
         if (! $user || ! Hash::check($data['password'], $user->password)) {
             return response()->json(['message' => 'Credenciales inválidas'], 401);
         }
        
         return response()->json(['user' => $user, 'token' => $user->createToken('taskflow')->plainTextToken]);
    }

    public function logout(Request $request)
    {
        // TODO(sesion-05): borra la línea de abajo y descomenta el bloque completo.
        //return response()->json(null, 501);
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada']);
    }
}
