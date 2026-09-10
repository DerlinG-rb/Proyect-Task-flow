<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// TODO(sesion-05): borra las 3 líneas de abajo y descomenta el bloque completo,
// que envuelve las mismas rutas en el middleware 'auth:sanctum'.
//Route::post('/logout', [AuthController::class, 'logout']);
//Route::get('/user', fn (Request $request) => $request->user());
//Route::apiResource('tasks', TaskController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn (Request $request) => $request->user());
  Route::apiResource('tasks', TaskController::class);
 });
